<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function showClientOrders($clientId){
        return "pedidos del cliente $clientId";
    }
}