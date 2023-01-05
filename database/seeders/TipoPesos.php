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
            'descripcion'=>"gr"
        ]);
        tipo_peso::create([
            'descripcion'=>"kg"
        ]);
        tipo_peso::create([
            'descripcion'=>"lb"
        ]);
        tipo_peso::create([
            'descripcion'=>"lt"
        ]);
        tipo_peso::create([
            'descripcion'=>"ml"
        ]);
        tipo_peso::create([
            'descripcion'=>"gal"
        ]);
        tipo_peso::create([
            'descripcion'=>"cc"
        ]);
    }
}
