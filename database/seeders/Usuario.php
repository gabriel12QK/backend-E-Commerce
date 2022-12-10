<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class Usuario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>"Gabriel",
            'last_name'=>"Rivas",
            'email'=>"admin@gmail.com",
            'password'=>Hash::make('12345678'),
            'cedula'=>"1111111111",
            'referencia'=>"xxxxxxxx",
            'direccion'=>"xxxxxxx",
            'telefono'=>"0999999999",
            'id_tipo_usuario'=>1,
            'estado'=>1
        ]);
       
    }
}
