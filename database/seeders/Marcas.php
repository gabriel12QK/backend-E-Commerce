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
            'estado'=>1
        ]);
        marca::create([
            'descripcion'=>'Colgate',
            'estado'=>1
        ]);
        marca::create([
            'descripcion'=>'Pepsi',
            'estado'=>1
        ]);
        marca::create([
            'descripcion'=>'Familia',
            'estado'=>1
        ]);
        marca::create([
            'descripcion'=>'Oreo',
            'estado'=>1
        ]);

    }
}
