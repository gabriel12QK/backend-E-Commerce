<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\situacion_promocion;

class SituacionPromocion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        situacion_promocion::create([
            'descripcion' => 'PUBLICADA',
            'estado' => 1
        ]);
        situacion_promocion::create([
            'descripcion' => 'EXPIRADA',
            'estado' => 1
        ]);
        situacion_promocion::create([
            'descripcion' => 'AGOTADA',
            'estado' => 1
        ]);
    }
}
