<?php

namespace App\Http\Controllers;

use App\Models\producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valiData=$request->validate([
            'nombre'=>'required|string|max:255',
            'precio'=>'required|max:255',
            'peso'=>'required|max:255',
            'stock'=>'required|integer',
            'imagen'=>'required|mimes:jpeg,bmp,png',
            'id_categoria'=>'required',
            'id_marca'=>'required',
            'id_tipo_peso'=>'required',
        ]);
        $producto=producto::create([
            'nombre'=>$valiData['nombre'],
            'precio'=>$valiData['precio'],
            'peso'=>$valiData['peso'],
            'stock'=>$valiData['stock'],
            'imagen'=>$valiData['imagen'],
            'id_categoria'=>$valiData['id_categoria'],
            'id_marca'=>$valiData['id_marca'],
            'estado'=>1,
            'id_tipo_peso'=>$valiData['id_tipo_peso'],
        ]);
        $img=$request->file('imagen');
        $validData['imagen'] = time().'.'.$img->getClientOriginalExtension();

 
        $request->file('imagen')->storeAs("public/images/producto/{$producto->id}", $validData['imagen']);
        return response()->json(['message'=>'Producto registrado'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(producto $producto)
    {
        //
    }
}
