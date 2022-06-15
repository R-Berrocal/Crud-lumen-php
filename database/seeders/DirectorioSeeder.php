<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DirectorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table("directorios")->insert([
        [
            'nombre_completo' => "Saul Manuel",
            'direccion' => "Plan 500, 234 entre sajama y sabaya",
            'telefono' => "761399",
            'url_foto' => null
        ],
        [
            'nombre_completo' => "Juan",
            'direccion' => "Plan 300",
            'telefono' => "12490",
            'url_foto' => null
        ],
    ]);
    }
}
