<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;
use Nette\Utils\Random;

class libroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();

        for($i=0; $i<200; $i++){
            DB::table('libro')->insert([
                'titulo' => $faker->sentence(4),
                'descripcion' => $faker->sentence(400),
                'cantidadPaginas' => $faker->numberBetween(100,2000),
                'urlImagen' => $faker->imageUrl(640, 480, 'Book', true),
                'disponible' => $faker->boolean(),
                'precio' => $faker->randomFloat(2, 50, 2000.99),
            ]);
        }
    }
}
