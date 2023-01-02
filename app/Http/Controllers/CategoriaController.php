<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoria = categoria::where('estado',1)->get();
        return response()->json($categoria, 200);
    }


    public function create()
    {
        //solo dios sabe que hace esto
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


        $categoria=categoria::create([
            'descripcion'=>$validateData['descripcion'],
            'imagen'=>$valiData['imagen'],
            'estado'=>1,
        ]);

        $request->file('imagen')->storeAs("public/images/categoria/{$categoria->id}", $valiData['imagen']);

        return response()->json(['message'=>'Categoria registrada'],200);
    }

    
    public function show($id)
    {
        $categoria=categoria::find($id);
        if (is_null($categoria)) {
            return response()->json(['message' => 'Categoria no encontrada'], 404);
        }
        return response()->json($categoria);
    }

    
    public function edit(categoria $categoria)
    {
        //
    }


    public function update(Request $request, categoria $categoria)
    {
        //
        $categoria = categoria::find($id);
        if (is_null($categoria)) {
            return response()->json(['message' => 'Categoria no encontrada.'], 404);
        }
        $validateData = $request->validate([
            'descripcion'=>'required|string|max:255'
        ]);

        $categoria->descripcion = $validateData['descripcion'];
        $categoria->save();

        return response()->json(['message' => 'Categoria actualizada'], 200);

    }

    
    public function destroy($id)
    {
        $categoria=categoria::find($id);
        if (is_null($categoria)) {
            return response()->json(['message' => 'Categoria no encontrada'], 404);
        }
        $categoria->estado=0;
        $categoria->save();
        return response()->json(['message'=>'Categoria eliminada']);
    }

    public function editImagen(Request $request, $id ){

        $categoria = categoria::find($id);
        if (is_null($categoria)) {
            return response()->json(['message' => 'Categoria no encontrada.'], 404);
        }
        $validateData = $request->validate([
            'imagen' => 'required|mimes:jpeg,bmp,png',
        ]);
        $img=$request->file('imagen');
        $validateData['imagen'] = time().'.'.$img->getClientOriginalExtension();
        $request->file('imagen')->storeAs("public/images/cate$categoria/{$categoria->id}", $validateData['imagen']);
        $categoria->imagen=$validateData['imagen'];
        $categoria->save();
        return response()->json(['message' => 'Foto de categoria actualizada'], 201);
    }



}
