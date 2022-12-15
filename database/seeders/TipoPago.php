<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\tipo_pago;

class TipoPago extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        tipo_pago::create([
            'descripcion' => "Efectivo"
        ]);

        tipo_pago::create([
            'descripcion' => "Transferencia"
        ]);

        /* tipo_pago::create([

        ]); */

    }
}
