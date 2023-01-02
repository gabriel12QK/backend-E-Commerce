<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\marca;
class Marcas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        marca::create([
            'descripcion'=>'Coca-Cola',
            'imagen'=>'imagen_default.jpg',
            'estado'=>1
        ]);
        marca::create([
            'descripcion'=>'Colgate',
            'imagen'=>'imagen_default.jpg',
            'estado'=>1
        ]);
        marca::create([
            'descripcion'=>'Pepsi',
            'imagen'=>'imagen_default.jpg',
            'estado'=>1
        ]);
        marca::create([
            'descripcion'=>'Familia',
            'imagen'=>'imagen_default.jpg',
            'estado'=>1
        ]);
        marca::create([
            'descripcion'=>'Oreo',
            'imagen'=>'imagen_default.jpg',
            'estado'=>1
        ]);

    }
}
