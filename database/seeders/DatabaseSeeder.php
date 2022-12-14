<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TipoPesos::class,
            TipoUsuarios::class,
            Usuario::class,
            Marcas::class,
            Categorias::class,
            TipoPago::class,
            EstadoOrden::class,
            SituacionPromocion::class
        ]);
    }
}
