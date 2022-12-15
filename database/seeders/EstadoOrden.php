<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\estado_orden;

class EstadoOrden extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        estado_orden::create([
            'descripcion' => "Por entregar"
        ]);
        estado_orden::create([
            'descripcion' => "En curso"
        ]);
        estado_orden::create([
            'descripcion' => "Entregada"
        ]);
        /* estado_orden::create([
            
        ]); */
    }
}
