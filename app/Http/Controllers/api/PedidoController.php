<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PedidoResource;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Libro;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonImmutable;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use MercadoPago;
use App\Traits\HttpResponses;

class PedidoController extends Controller
{
    
    /**
     * @OA\Post(
     *     path="/pedidos",
     *     tags={"Pedido"},
     *     summary="Crear un nuevo pedido",  
     *     description="Crear un nuevo pedido con la información del cliente y los libros elegidos",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             ref="#/components/schemas/PedidoBody",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Pedido creado exitosamente",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/PedidoCreado"
     *         ),
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Formato invalido para los datos",
     *     ),
     * )
     * 
     * 
     * 
     * @OA\Schema(
     *     schema="PedidoBody",
     *     @OA\Property(
     *         property="cliente",
     *         type="object",
     *         @OA\Property(
     *             property="nombre",
     *             type="string",
     *             example="Tom"
     *         ),
     *         @OA\Property(
     *             property="apellido",
     *             type="string",
     *             example="Perez"
     *         ),
     *         @OA\Property(
     *             property="mail",
     *             type="string",
     *             format="email"
     *         ),
     *         @OA\Property(
     *             property="direccion",
     *             type="string",
     *             example="Calle Bonita 1234"
     *         )
     *     ),
     *     @OA\Property(
     *         property="libros",
     *         type="array",
     *         @OA\Items(
     *             type="object",
     *             @OA\Property(
     *                 property="id",
     *                 type="integer",
     *                 example="2"
     *             ),
     *             @OA\Property(
     *                 property="cantidad",
     *                 type="integer",
     *                 example="4"
     *             )
     *         )
     *     )
     * )
     * 
     * @OA\Schema(
     *     schema="PedidoCreado",
     *     type="object",
     *     required={"data"},
     *     @OA\Property(
     *         property="data",
     *         type="object",
     *         @OA\Property(
     *             property="id",
     *             type="integer",
     *             example=149,
     *         ),
     *         @OA\Property(
     *             property="fecha",
     *             type="string",
     *             example="2023-05-08",
     *         ),
     *         @OA\Property(
     *             property="precio_total",
     *             type="number",
     *             example=2095442.58,
     *         ),
     *         @OA\Property(
     *             property="cliente",
     *             type="object",
     *             @OA\Property(
     *                 property="id",
     *                 type="integer",
     *                 example=107,
     *             ),
     *             @OA\Property(
     *                 property="nombre",
     *                 type="string",
     *                 example="Tom",
     *             ),
     *             @OA\Property(
     *                 property="apellido",
     *                 type="string",
     *                 example="Perez",
     *             ),
     *             @OA\Property(
     *                 property="direccion",
     *                 type="string",
     *                 example="Calle Bonita 1234",
     *             ),
     *             @OA\Property(
     *                 property="mail",
     *                 description="The email of the client",
     *                 type="string",
     *                 example="user@example.com",
     *             ),
     *         ),
     *         @OA\Property(
     *             property="libros",
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(
     *                     property="titulo",
     *                     type="string",
     *                     example="Enim quia culpa nihil est.",
     *                 ),
     *                 @OA\Property(
     *                     property="precio_unitario",
     *                     type="string",
     *                     example="698480.86",
     *                 ),
     *                 @OA\Property(
     *                     property="cantidad_unidades",
     *                     type="integer",
     *                     example=3,
     *                 ),
     *             ),
     *         ),
     *     ),
     * )
     *
     *
     */

    public function store(Request $request)
    {  
        //Validación de los libros
        $request->validate([
            'libros' => 'required|array',
            'libros.*.id' => [
                'required',
                'numeric',
                'distinct',
                'exists:libro,id,disponible,true'
            ],
            'libros.*.cantidad' => 'required|integer|min:1'
        ]);
        $paymentApproved=$this->checkMercadoPagoStatus($request->formData);
        if($paymentApproved){
            $client = $request->user();
            //Crear pedido y asociarle el cliente
            $pedido = new Pedido();
            $pedido->fecha = CarbonImmutable::today()->format('Y-m-d');
            $pedido->cliente()->associate($client);
            $pedido->save();
    
            //Crear colleccion de libros para vincularlos al pedido
            $books = collect($request->input('libros'));
            $booksAttach = $books->mapWithKeys(function(array $item, int $key){
                $LibroModel = Libro::find($item['id']);
                return [$item['id'] => ['cantidadUnidades' => $item['cantidad'], 'precioUnitario' => $LibroModel->precio]];
            });
    
            $pedido->libros()->attach($booksAttach);
    
            return new PedidoResource($pedido);
        }else{
            return response()->json([
                'status' => 'Error occurred.',
                'message' => "Pago no aceptado por Mercado Pago",
                'data' => "",
            ], 422);
        }
    }

    private function checkMercadoPagoStatus($contents){
        MercadoPago\SDK::setAccessToken(config('mercadopago.mp_access_token'));
        
        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = $contents['transaction_amount'];
        $payment->token = $contents['token'];
        $payment->installments = $contents['installments'];
        $payment->payment_method_id = $contents['payment_method_id'];
        $payment->issuer_id = $contents['issuer_id'];
        $payer = new MercadoPago\Payer();
        $payer->email = $contents['payer']['email'];
        $payer->identification = [
            "type" => $contents['payer']['identification']['type'],
            "number" => $contents['payer']['identification']['number']
        ];
        $payment->payer = $payer;
        $payment->save();
        return $payment->status=='approved';
    }
    

    


}
