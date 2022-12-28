<?php

namespace App\Http\Controllers;

use App\Models\tipo_promocion;
use Illuminate\Http\Request;

class TipoPromocionController extends Controller
{
    
    public function index()
    {
        //
        $tipo_promocion = tipo_promocion::where('estado', 1)->get();
        return response()->json($tipo_promocion, 200);
    }

    
    public function create()
    {
        //nunca entendi que hace esto
    }

    
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'descripcion' => 'required|string|max:255'
        ]);

        $tipo_promocion = tipo_promocion::create([
            'descripcion' => $validateData['descripcion'],
            'estado' => 1
        ]);

        return response()->json(['message' => 'Tipo de promoción registrada.'], 201);
    }

    
    public function show($id)
    {
        //
        $tipo_promocion = tipo_promocion::find($id);

        if(is_null($marca)){
            return response()->json(['message' => 'Tipo de promoción no encontrado'], 404);
        }

        return response()->json($tipo_promocion, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tipo_promocion  $tipo_promocion
     * @return \Illuminate\Http\Response
     */
    public function edit(tipo_promocion $tipo_promocion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tipo_promocion  $tipo_promocion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $tipo_promocion = tipo_promocion::find($id);

        if(is_null($marca)){
            return response()->json(['message' => 'Tipo de promoción no encontrado'], 404);
        }
        $validateData = $request->validate([
            'descripcion' => 'required|string|max:255'
        ]);
        
        $tipo_promocion->descripcion = $validateData['descripcion'];
        $tipo_promocion->save();

        return response()->json(['message' => 'Tipo de promoción actualizado', 201]);
    }

    
    public function destroy($id)
    {
        //
        $tipo_promocion = tipo_promocion::find($id);

        if(is_null($marca)){
            return response()->json(['message' => 'Tipo de promoción no encontrado'], 404);
        }
        
        
        $tipo_promocion->estado = 0;
        $tipo_promocion->save();

        return response()->json(['message' => 'Tipo de promoción eliminado', 201]);

    }
}
