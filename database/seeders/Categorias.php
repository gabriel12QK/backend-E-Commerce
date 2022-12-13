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
            'estado'=>1
        ]);
        categoria::create([
            'descripcion'=>'Conveniencia',
            'estado'=>1
        ]);
        categoria::create([
            'descripcion'=>'Alcohol',
            'estado'=>1
        ]);
        categoria::create([
            'descripcion'=>'Ofertas',
            'estado'=>1
        ]);
        categoria::create([
            'descripcion'=>'Farmacia',
            'estado'=>1
        ]);
        categoria::create([
            'descripcion'=>'Mascotas',
            'estado'=>1
        ]);

    }
}
