<?php

namespace App\Http\Controllers;

use App\Models\tipo_peso;
use Illuminate\Http\Request;

class TipoPesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_peso = tipo_peso::where('estado',1)->get();
        return response()->json($tipo_peso, 200);

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
        $validateData=$request->validate([
            'descripcion'=>'required|string|max:255'
        ]);
        $tipo_peso=tipo_peso::create([
            'descripcion'=>$validateData['descripcion'],
            'estado'=>1,
        ]);
        return response()->json(['message'=>'tipo peso registrado'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tipo_peso  $tipo_peso
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo_peso=tipo_peso::find($id);
        if (is_null($tipo_peso)) {
            return response()->json(['message' => 'Tipo_peso no encontrada'], 404);
        }
        return response()->json($tipo_peso);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tipo_peso  $tipo_peso
     * @return \Illuminate\Http\Response
     */
    public function edit(tipo_peso $tipo_peso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tipo_peso  $tipo_peso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tipo_peso $tipo_peso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tipo_peso  $tipo_peso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_peso=tipo_peso::find($id);
        if (is_null($tipo_peso)) {
            return response()->json(['message' => 'tipo_peso no encontrada'], 404);
        }
        $tipo_peso->estado=0;
        $tipo_peso->save();
        return response()->json(['message'=>'tipo_peso eliminada']);
    }
    }

