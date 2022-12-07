<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\tipo_peso;
class TipoPesos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        tipo_peso::create([
            'descripcion'=>"Gramo"
        ]);
        tipo_peso::create([
            'descripcion'=>"Kilogramo"
        ]);
        tipo_peso::create([
            'descripcion'=>"Libras"
        ]);
        tipo_peso::create([
            'descripcion'=>"Litros"
        ]);
        tipo_peso::create([
            'descripcion'=>"Mililitros"
        ]);
        tipo_peso::create([
            'descripcion'=>"Galones"
        ]);
    }
}
