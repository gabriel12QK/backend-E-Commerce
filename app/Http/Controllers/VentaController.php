<?php

namespace App\Http\Controllers;

use App\Models\venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venta=venta::where('estado',1)->get();
        return response()->json($venta);
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
     * @param  \App\Models\venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(venta $venta)
    {
        //
    }

    public function ShowVenta()
    {
        $dataVenta=Array();
        $dataProductos=Array();
        $datakit=Array();
        $venta= DB::table('ventas')
        ->join('detalle_ventas','ventas.id','=','detalle_ventas.id_venta')
        ->join('users','ventas.id_user', '=','users.id')
        ->join('tipo_pagos','ventas.id_tipo_pago','=','tipo_pagos.id')
        ->select('ventas.*',
        'users.name','users.last_name','users.cedula','users.id as userId',
        'detalle_ventas.precio','detalle_ventas.cantidad','detalle_ventas.id_producto','detalle_ventas.id_promocion_producto','detalle_ventas.id_registro_promocion',
        'tipo_pagos.descripcion as tipo_pago'
        )
        ->where('ventas.estado',1)
        ->get();
        
       foreach ($venta as $key => $value) {
        if ($value->id_producto!=null) {
                       $detalleVentaProducto=DB::table('detalle_ventas')
                       ->join('ventas','detalle_ventas.id_venta','=','ventas.id')
                        ->join('productos','detalle_ventas.id_producto','=','productos.id')
                        ->select('productos.nombre as nombreArticulo', 'productos.precio','detalle_ventas.cantidad')
                        ->where('detalle_ventas.id_venta',$value->id)
                        ->where('ventas.id_user',$value->userId)
                        ->get();
                       array_push($dataVenta,['nombreComprador'=>$value->name,'apellidoComprador'=>$value->last_name,'ventaId'=>$value->id, 'subtotal'=>$value->subtotal,'total'=>$value->total,'cantidad'=>$value->cantidad,'fechaVenta'=>$value->fecha ,'Articulo'=>$detalleVentaProducto,]);
                            } 
        else if ($value->id_registro_promocion!=null) {
                 $detalleVentaKit=DB::table('detalle_ventas')
                 ->join('registro_promocions','detalle_ventas.id_registro_promocion','=','registro_promocions.id')
                  ->join('precio_kits','registro_promocions.id','=','precio_kits.id_registro_promocion')
                  ->join('tipo_promocions','registro_promocions.id_tipo_promocion','=','tipo_promocions.id')
                  ->join('kits','registro_promocions.id','=','kits.id')
                  ->select('registro_promocions.*','tipo_promocions.descripcion as tipoDescripcion','kits.id as kitId','precio_kits.precio as precioKit')
                 ->where('registro_promocions.estado',1)
                // ->where('registro_promocions.id',$id)
                  ->get();
                  $kits=DB::table('kits')
                    ->join('productos','kits.id_producto','=','productos.id')
                    ->join('tipo_pesos','productos.id_tipo_peso','=','tipo_pesos.id')
                    ->select('kits.cantidad','productos.nombre','productos.peso','tipo_pesos.descripcion')
                    ->where('id_registro_promocion',$value->id_registro_promocion)
                    ->get();
                    foreach ($detalleVentaKit as $key => $value1) {
                        array_push($datakit,['venta'=>$value1->descripcion,'nombreArticulo'=>$value1->tipoDescripcion,'precioKit'=>$value1->precioKit,'cantidadRestante'=>$value1->cantidad_restante,'subtotal'=>$value->subtotal,'total'=>$value->total,'cantidad'=>$value->cantidad,'fechaVenta'=>$value->fecha,'contenidoKit'=>$kits]);
                    }
                    array_push($dataVenta,['nombreComprador'=>$value->name,'apellidoComprador'=>$value->last_name,'ventaId'=>$value->id,'cantidad'=>$value->cantidad,'fechaVenta'=>$value->fecha,'subtotal'=>$value->subtotal,'total'=>$value->total,'Articulo'=>$datakit,]);
                   
        }
        else if ($value->id_promocion_producto) {
                $detalleVentaPromocion=DB::table('detalle_ventas')
                ->join('ventas','detalle_ventas.id_venta','=','ventas.id')
                ->join('promocion_productos','detalle_ventas.id_promocion_producto','=','promocion_productos.id')
                ->join('productos','promocion_productos.id_producto','=','productos.id')
                ->select('productos.nombre as nombreArticulo', 'productos.precio','detalle_ventas.cantidad','promocion_productos.descuento')
                ->where('detalle_ventas.id_venta',$value->id)
                ->where('ventas.id_user',$value->userId)
                ->get();
                array_push($dataVenta,['nombreComprador'=>$value->name,'apellidoComprador'=>$value->last_name,'ventaId'=>$value->id,'subtotal'=>$value->subtotal,'total'=>$value->total,'cantidad'=>$value->cantidad,'fechaVenta'=>$value->fecha,'Articulo'=>$detalleVentaPromocion,]);
           
        }
           
       }
    
        return response()->json($dataVenta);
    }
}
