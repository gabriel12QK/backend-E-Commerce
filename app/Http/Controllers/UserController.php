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
        $user = User::where('estado',1)->get();
        return response()->json($user, 200);
    }

    public function register(Request $request)
    {
       //return response()->json($request);
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

        $type=2;

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

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Credenciales invalidas'], 401);
        }
        $user = User::where('email', $request->email)->first();

        $token = $user->createToken('auth_token')->plainTextToken;
        $query = DB::table('users')
            ->join('tipo_usuarios', 'users.id_tipo_usuario', '=', 'tipo_usuarios.id')
            ->select('users.*', 'tipo_usuarios.*')
            ->where('users.email', $user->email)
            ->get();
        return response()->json(
            [
                'accesToken'=>$token,
                'tokenType'=>'Bearer',
                'typeUserId'=>$user->id_tipo_usuario,
                'id'=>$user->id,
                'userName'=>$user->name,
                'email'=>$user->email,
                'rol'=>$query[0]->tipo_usuario,
            ],
            200

        );
    }

    public function editUserEmail(Request $request, $id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['message' => 'usuario no encontrado'], 404);
        }
        $validateData = $request->validate([
            'email' => 'required|email|max:50|unique:users',
        ]);
        $user->email = $validateData['email'];
        $user->save();
        return response()->json(['message' => 'actualizado'], 201);
    }
    
    public function editPassword(Request $request, $id){
        $user = User::find($id);
        if(is_null($user)){
            return response()->json(['message' => 'usuario no encontrado'], 404);
        }
        $validateData = $request->validate([
            'password' => 'required|string|max:50|unique:users',
        ]);
        $validateData['password'] = Hash::make($validateData['password']);
        $user->password = $validateData['password'];
        $user->save();
        return response()->json(['message' => 'Contraseña actualizada'], 201);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['message' => 'usuario no encontrado'], 404);
        }
        $user->state =false;
        $user->save();
        return response()->json(['message' => 'eliminado'], 200);
    }

    public function Show($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['message' => 'usuario no encontrado'], 404);
        }
        return response()->json($user);
    }

    public function registerRepartidor(Request $request){

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

        $type = 3;

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
    
     
        $request->file('imagen')->storeAs("public/images/repartidor/{$user->id}", $validData['imagen']);
    
        return response()->json(['message' => 'Usuario registrado'], 200);

    }

    public function getAllRepartidores(){
        $repartidores = User::where('id_tipo_usuario', 3)->where('estado', 1)->get();
        return response()->json($repartidores, 200);
    }

    public function updateImage(Request $request, $id)
    {

        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['message' => 'No encontrado'], 404);
        }
        $validData = $request->validate([
            'imagen' => 'required|image|mimes:jpg,jpeg,png,gif,svg'
        ]);

        $validData['imagen'] = $request->file('imagen')->getClientOriginalName();
        $request->file('imagen')->storeAs("public/images/persona/{$user->id}", $validData['imagen']);

        /*  if ($person->image != '') {
            unlink(storage_path("app/public/images/persons/{$person->userId}/" . $person->image));
        } */
        $user->imagen = $validData['imagen'];
        $user->save();
        return response()->json(['message' => 'Imagen actualizada'], 201);
    }


    public function updateUser(Request $request, $id){
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['message' => 'No encontrado'], 404);
        }
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'referencia'=>'required',
            'direccion'=>'required|string|max:255',
            'telefono'=>'required|string',
            //'cedula'=>'required|string|max:10',
            'email' => 'required|string|email|max:255',
           // 'password' => 'required|string|min:8',
           // 'imagen'=>'required'
        ]);
        $user->name=$validateData['name'];
        $user->last_name=$validateData['last_name'];
        $user->referencia=$validateData['referencia'];
        $user->direccion=$validateData['direccion'];
        $user->telefono=$validateData['telefono'];
        $user->email=$validateData['email'];
        // $user->name=$validateData['name'];
        $user->save();
        return response()->json(['message' => 'actualizado'], 201);
    }
}
