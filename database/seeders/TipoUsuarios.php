<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\tipo_usuario;

class TipoUsuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        tipo_usuario::create([
            'tipo_usuario'=>"Administrador"
        ]);
        tipo_usuario::create([
            'tipo_usuario'=>"Usuario"
        ]);
        tipo_usuario::create([
            'tipo_usuario'=>"Repartidor"
        ]);
    }
}
