<?php

namespace App\Http\Controllers;

use App\Models\kit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class KitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kit = kits::where('estado',1)->get();
        return response()->json($kit, 200);
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
            'cantidad'=>'required',
            'id_registro_promocion'=>'required',
            'id_producto'=>'required',
        ]);
        $kit=kits::create([
            'cantidad'=>$validateData['cantidad'],
            'id_registro_promocion'=>$validateData['id_registro_promocion'],
            'id_producto'=>$validateData['id_producto'],
            'estado'=>1,
        ]);

        return response()->json(['message'=>'oferta registrada'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function show(kit $id)
    {
        $kit=kits::find($id);
        if (is_null($kit)) {
            return response()->json(['message' => 'kits no encontrada'], 404);
        }
        return response()->json($kit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function edit(kit $kit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $kit = kits::find($id);
        if (is_null($kit)) {
            return response()->json(['message' => 'kits no encontrada'], 404);
        }
        $validateData=$request->validate([
            'cantidad'=>'required',
            'id_registro_promocion'=>'required',
            'id_producto'=>'required',
        ]);

        $kit->cantidad = $validateData['cantidad'];
        $kit->id_registro_promocion = $validateData['id_registro_promocion'];
        $kit->id_producto = $validateData['id_producto'];
        $kit->save();

        return response()->json(['message'=>'kits actualizado'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function destroy(kit $id)
    {
        $kit=kits::find($id);
        if (is_null($kit)) {
            return response()->json(['message' => 'kits no encontrada'], 404);
        }
        $kit->estado = 0;
        $kit->save();
        return response()->json(['message'=>'kits eliminado']);
    }
    public function showOfertaskits()
    {
        $data=Array();
        $promo=DB::table('registro_promocions')
       // ->join('nombre_tabla','campo a comparar de la tabla principal','=','')
       // ->join ('productos','kits.id_producto','=','productos.id')
        //->join('registro_promocions','kits.id_registro_promocion','=','registro_promocions.id')
        ->join('precio_kits','registro_promocions.id','=','precio_kits.id_registro_promocion')
        ->select('registro_promocions.*','precio_kits.precio as precioKit')
        ->where('registro_promocions.estado',1)
        ->where('precio_kits.estado',1)
        ->get();

        
      
        return response()->json($promo, 200);
    }
}
