<?php

namespace App\Http\Controllers;

use App\Models\promocion_producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class PromocionProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promocion=promocion_producto::where('estado',1)->get();
        return response()->json($promocion);
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
            'stock'=>'required',
            'descuento'=>'required',
            'fecha_inicio'=>'required',
            'fecha_fin'=>'required',
            'id_producto'=>'required'
        ]);
        $promocion=promocion_producto::create([
            'stock'=>$validateData['stock'],
            'descuento'=>$validateData['descuento'],
            'fecha_inicio'=>$validateData['fecha_inicio'],
            'fecha_fin'=>$validateData['fecha_fin'],
            'id_producto'=>$validateData['id_producto'],
            'estado'=>1,
        ]);
        return response()->json(['message'=>'Promocion registrada']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\promocion_producto  $promocion_producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promocion = promocion_producto::find($id);
        if (is_null($promocion)) {
            return response()->json(['message' => 'Promocion no encontrada'], 404);
        }
        return response()->json($promocion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\promocion_producto  $promocion_producto
     * @return \Illuminate\Http\Response
     */
    public function edit(promocion_producto $promocion_producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\promocion_producto  $promocion_producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $promocion = promocion_producto::find($id);
        if (is_null($promocion)) {
            return response()->json(['message' => 'Promocion no encontrada'], 404);
        }
        $validateData=$request->validate([
            'stock'=>'required',
            'descuento'=>'required',
           'fecha_inicio'=>'required',
           'fecha_fin'=>'required',
           'id_producto'=>'required',
        ]);

        $promocion->stock = $validateData['stock'];
        $promocion->descuento = $validateData['descuento'];
        $promocion->fecha_inicio = $validateData['fecha_inicio'];
        $promocion->fecha_fin = $validateData['fecha_fin'];
        $promocion->id_producto = $validateData['id_producto'];
        $promocion->save();

        return response()->json(['message'=>'promocion actualizada'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\promocion_producto  $promocion_producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promocion = promocion_producto::find($id);
        if (is_null($promocion)) {
            return response()->json(['message' => 'Promocion no encontrada'], 404);
        }
        $promocion->estado=0;
        $promocion->save();
        return response()->json(['message'=>'promocion actualizada'],200);
    }


    public function showPromocionProducto($id){
        $pro = promocion_producto::find($id);
        if($pro == []){
            return response()->json(['message'=> "Promoción producto no encontrada"], 404);
        }

        $promocion=DB::table('promocion_productos')
        ->join('productos','promocion_productos.id_producto','=','productos.id')
        ->join('precio_promocion_productos', 'precio_promocion_productos.id_promocion_producto', '=', 'promocion_productos.id')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->join('tipo_pesos','productos.id_tipo_peso','=','tipo_pesos.id')
        ->join('categorias','productos.id_categoria','=','categorias.id')
        ->select('productos.*','promocion_productos.descuento','promocion_productos.stock as stockPromo','promocion_productos.fecha_inicio','promocion_productos.fecha_fin', 'precio_promocion_productos.precio as precioPromo', 'marcas.descripcion as marca','tipo_pesos.descripcion as tipo_peso','categorias.descripcion as categoria')
        ->where('promocion_productos.id',$id)
        ->where('promocion_productos.estado',1)
        ->get();

        return response()->json($promocion);
    }
    public function PromocionProducto(){
        $promocion=DB::table('promocion_productos')
        ->join('productos','promocion_productos.id_producto','=','productos.id')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->join('tipo_pesos','productos.id_tipo_peso','=','tipo_pesos.id')
        ->join('categorias','productos.id_categoria','=','categorias.id')
        ->join('precio_promocion_productos', 'precio_promocion_productos.id_promocion_producto', '=', 'promocion_productos.id')
        ->select('productos.*','promocion_productos.descuento','promocion_productos.stock as stockPromo','promocion_productos.fecha_inicio','promocion_productos.fecha_fin', 'precio_promocion_productos.precio as precioPromo', 'marcas.descripcion as marca','tipo_pesos.descripcion as tipo_peso','categorias.descripcion as categoria')
        ->where('promocion_productos.estado',1)
        ->get();

        return response()->json($promocion);
    }
}
