<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\categoria;
class Categorias extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        categoria::create([
            'descripcion'=>'Gaseosas',
            'imagen'=>'imagen_default.jpg',
            'estado'=>1
        ]);
        categoria::create([
            'descripcion'=>'Conveniencia',
            'imagen'=>'imagen_default.jpg',
            'estado'=>1
        ]);
        categoria::create([
            'descripcion'=>'Alcohol',
            'imagen'=>'imagen_default.jpg',
            'estado'=>1
        ]);
        categoria::create([
            'descripcion'=>'Ofertas',
            'imagen'=>'imagen_default.jpg',
            'estado'=>1
        ]);
        categoria::create([
            'descripcion'=>'Farmacia',
            'imagen'=>'imagen_default.jpg',
            'estado'=>1
        ]);
        categoria::create([
            'descripcion'=>'Mascotas',
            'imagen'=>'imagen_default.jpg',
            'estado'=>1
        ]);

    }
}
