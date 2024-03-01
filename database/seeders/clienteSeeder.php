<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;
class clienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();

        //Test lient
        DB::table('cliente')->insert([
            'nombre' => $faker->firstName,
            'apellido' => $faker->lastName,
            'direccion' => $faker->address,
            'password' => Hash::make("client123"),
            'mail' => "client@iaw.com",
        ]);

        for ($i = 0; $i < 100; $i++) {
            DB::table('cliente')->insert([
                'nombre' => $faker->firstName,
                'apellido' => $faker->lastName,
                'direccion' => $faker->address,
                'password' => Hash::make("client123"),
                'mail' => $faker->unique()->email,
            ]);
        }
    }
}
