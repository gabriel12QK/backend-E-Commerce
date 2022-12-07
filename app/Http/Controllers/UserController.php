<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return response()->json($user, 200);
    }
    public function register(Request $request)
    {
       // return response()->json($request);
         $validData = $request->validate([
        'name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'referencia'=>'required',
        'direccion'=>'required|string|max:255',
        'telefono'=>'required|string',
        'cedula'=>'required|string|max:10',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'imagen'=>'required'
    ]);
        $type=3;
    $user = User::create([
        'name' => $validData['name'],
        'last_name' => $validData['last_name'],
        'email' => $validData['email'],
        'referencia' => $validData['referencia'],
        'direccion' => $validData['direccion'],
        'telefono' => $validData['telefono'],
        'cedula' => $validData['cedula'],
        'password' => Hash::make($validData['password']),
        'imagen' => $validData['imagen'],
        'estado' => 1,
        'id_tipo_usuario' => $type,
    ]);

    //imagen
    $img=$request->file('imagen');
    $validData['imagen'] = time().'.'.$img->getClientOriginalExtension();

 
    $request->file('imagen')->storeAs("public/images/persona/{$user->id}", $validData['imagen']);

    return response()->json(['message' => 'Usuario registrado'], 200);
    }
   
}
