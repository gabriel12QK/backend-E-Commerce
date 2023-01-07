<?php

namespace App\Http\Controllers;

use App\Models\marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    
    public function index()
    {
        $marca = marca::where('estado',1)->get();
        return response()->json($marca, 200);
    }

    
    public function create()
    {
       //a
    }

    
    public function store(Request $request)
    {
        $validateData=$request->validate([
            'descripcion'=>'required|string|max:255',
            'imagen' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //imagen
        $img = $request->file('imagen');
        $valiData['imagen'] =  time().'.'.$img->getClientOriginalExtension();
        $marca=marca::create([
            'descripcion'=>$validateData['descripcion'],
            'imagen'=>$valiData['imagen'],
            'estado'=>1,
        ]);

        $request->file('imagen')->storeAs("public/images/marca/{$marca->id}", $valiData['imagen']);
        return response()->json(['message'=>'Marca registrada'], 201);
    }

    
    public function show($id)
    {
        $marca=marca::find($id);
        if (is_null($marca)) {
            return response()->json(['message' => 'Marca no encontrada'], 404);
        }
        return response()->json($marca);
    }

    public function edit(marca $marca)
    {
        //a
    }

    
    public function update(Request $request, $id)
    {
        //
        $marca = marca::find($id);
        if (is_null($marca)) {
            return response()->json(['message' => 'Marca no encontrada.'], 404);
        }
        $validateData = $request->validate([
            'descripcion'=>'required|string|max:255'
        ]);

        $marca->descripcion = $validateData['descripcion'];
        $marca->save();

        return response()->json(['message' => 'Marca actualizada'], 200);
    }

    
    public function destroy($id)
    {
        $marca=marca::find($id);
        if (is_null($marca)) {
            return response()->json(['message' => 'Marca no encontrada'], 404);
        }
        $marca->estado = 0;
        $marca->save();
        return response()->json(['message'=>'Marca eliminada']);
    }

    public function editImagen(Request $request, $id ){

        $marca = marca::find($id);
        if (is_null($marca)) {
            return response()->json(['message' => 'marca no encontrada.'], 404);
        }
        $validateData = $request->validate([
            'imagen' => 'required|mimes:jpeg,bmp,png',
        ]);
        $img=$request->file('imagen');
        $validateData['imagen'] = time().'.'.$img->getClientOriginalExtension();
        $request->file('imagen')->storeAs("public/images/cate$marca/{$marca->id}", $validateData['imagen']);
        $marca->imagen=$validateData['imagen'];
        $marca->save();
        return response()->json(['message' => 'Foto de marca actualizada'], 201);
    }




}
