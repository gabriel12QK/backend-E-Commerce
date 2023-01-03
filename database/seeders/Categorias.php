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
            'descripcion'=>'Bebidas',
            'imagen'=>'imagen_default.jpg',
            'estado'=>1
        ]);
        categoria::create([
            'descripcion'=>'Mercado',
            'imagen'=>'imagen_default.jpg',
            'estado'=>1
        ]);
        categoria::create([
            'descripcion'=>'Alcohol',
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
        categoria::create([
            'descripcion'=>'Ofertas',
            'imagen'=>'imagen_default.jpg',
            'estado'=>1
        ]);

    }
}


// estos son intentos de seedear las imagenes 

// habia que tocar algo tambien en fatabase/factories/Userfactory.php

// 'imagen'=>$this->faker->save(storgate_path(path :'app/public/categoria/mercado.png', width:500,height:500, category:null,fullPath:true)),


// 'imagen'=>$this->image(storgate_path(path :'app/public/categoria/farmacias.png', width:500,height:500, category:null,fullPath:false)),


// image imageURL 

