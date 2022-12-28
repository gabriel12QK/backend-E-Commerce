<?php

namespace App\Http\Controllers;

use App\Models\marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marca = marca::where('estado',1)->get();
        return response()->json($marca, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData=$request->validate([
            'descripcion'=>'required|string|max:255'
        ]);
        $marca=marca::create([
            'descripcion'=>$validateData['descripcion'],
            'estado'=>1,
        ]);

        return response()->json(['message'=>'Marca registrada'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marca=marca::find($id);
        if (is_null($marca)) {
            return response()->json(['message' => 'Marca no encontrada'], 404);
        }
        return response()->json($marca);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, marca $marca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marca=marca::find($id);
        if (is_null($marca)) {
            return response()->json(['message' => 'Marca no encontrada'], 404);
        }
        $marca->estado = 0;
        $marca->save();
        return response()->json(['message'=>'marca eliminada']);
    }
}
