<?php

namespace App\Http\Controllers;

use App\Models\registro_promocion;
use App\Models\kit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class RegistroPromocionController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\registro_promocion  $registro_promocion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\registro_promocion  $registro_promocion
     * @return \Illuminate\Http\Response
     */
    public function edit(registro_promocion $registro_promocion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\registro_promocion  $registro_promocion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, registro_promocion $registro_promocion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\registro_promocion  $registro_promocion
     * @return \Illuminate\Http\Response
     */
    public function destroy(registro_promocion $registro_promocion)
    {
        //
    }

    public function showPromocion($id)
    {
        $data=Array();
        $promo=DB::table('registro_promocions')
        ->join('precio_kits','registro_promocions.id','=','precio_kits.id_registro_promocion')
        ->join('tipo_promocions','registro_promocions.id_tipo_promocion','=','tipo_promocions.id')
        ->join('kits','registro_promocions.id','=','kits.id')
       ->select('registro_promocions.*','tipo_promocions.descripcion as tipoDescripcion','kits.id as kitId','precio_kits.precio as precioKit')
       ->where('registro_promocions.estado',1)
       ->where('registro_promocions.id',$id)
        ->get();

        $kits=DB::table('kits')
        ->join('productos','kits.id_producto','=','productos.id')
        ->join('tipo_pesos','productos.id_tipo_peso','=','tipo_pesos.id')
        ->select('kits.cantidad','productos.nombre','productos.peso','tipo_pesos.descripcion')
        ->where('id_registro_promocion',$id)
        ->get();
        foreach ($promo as $key => $value) {
            array_push($data,['descripcionKit'=>$value->descripcion,'tipoPromocion'=>$value->tipoDescripcion,'precioKit'=>$value->precioKit,'cantidadRestante'=>$value->cantidad_restante,'contenidoKit'=>$kits]);
        }
      
        return response()->json($data);
    }

}
