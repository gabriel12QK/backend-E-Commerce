<?php

namespace App\Http\Controllers;

use App\Models\orden;
use App\Models\venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class OrdenController extends Controller
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
     * @param  \App\Models\orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function show(orden $orden)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function edit(orden $orden)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, orden $orden)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function destroy(orden $orden)
    {
        //
    }


    public function ShowOrdenEstado()
    {
        $Entregada=Array();
        $Por_Entregar=Array();
        $En_Curso=Array();
        $Pedidos=Array();
            $orden= DB::table('ordens')
            ->join('estado_ordens','ordens.id_estado_orden','=','estado_ordens.id')
            ->join('users','ordens.id_repartidor','=','users.id')
            ->join('ventas','ordens.id_venta','=','ventas.id')
            ->join('tipo_pagos','ventas.id_tipo_pago','=','tipo_pagos.id')
            ->join('detalle_ventas','ventas.id','=','detalle_ventas.id_venta')
            ->join('productos','detalle_ventas.id_producto','=','productos.id')
            ->select('ordens.*','users.name as repartidor','users.last_name','users.cedula','ventas.subtotal','ventas.total','ventas.fecha','tipo_pagos.descripcion',
                    'productos.nombre','estado_ordens.descripcion as estado_orden')
            ->where('ordens.estado',1)
            ->get();
            foreach($orden as $key=>$value)
            {
                $venta=DB::table('ordens')
                ->join('ventas','ordens.id_venta','=','ventas.id')
                ->join('users','ventas.id_user','=','users.id')
                ->select('users.name','users.last_name','users.cedula')
                ->where('ordens.estado',1)
                ->where('ordens.id',$value->id)
                ->get();
               switch ($value->id_estado_orden) {
                case '1':
                           array_push($Por_Entregar,['repartidor_name'=>$value->repartidor ,'repartidor_lastname'=>$value->last_name,'numero_pedido'=>$value->id,'fecha_venta'=>$value->fecha,'total'=>$value->total,'forma_pago'=>$value->descripcion, 'estado'=>$value->estado_orden, 'destinatario'=>$venta]); 
                    break;
                case '2':
                            array_push($En_Curso,['repartidor'=>$value->repartidor,'repartidor_lastname'=>$value->last_name,'numero_pedido'=>$value->id,'fecha_venta'=>$value->fecha,'total'=>$value->total,'forma_pago'=>$value->descripcion, 'estado'=>$value->estado_orden, 'destinatario'=>$venta]);
                    break;
                case '3':
                            array_push($Entregada,['repartidor'=>$value->repartidor,'repartidor_lastname'=>$value->last_name,'numero_pedido'=>$value->id,'fecha_venta'=>$value->fecha,'total'=>$value->total,'forma_pago'=>$value->descripcion, 'estado'=>$value->estado_orden, 'destinatario'=>$venta]);
                break;
                
                default:
                    # code...
                    break;
               } 
            }
            array_push($Pedidos,['entregados'=>$Entregada,'por_entregar'=>$Por_Entregar,'en_curso'=>$En_Curso]);
            return response()->json($Pedidos,200);
    }
}
