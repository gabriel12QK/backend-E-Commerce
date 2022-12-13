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
        $producto = producto::where('estado',1)->get();
        return response()->json($producto, 200);
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
    public function show($id)
    {
        $producto= producto::find($id);
        if (is_null($producto)) {
            return response()->json(['message'=> "Producto no encontrado"],404);
        }
        return response()->json($producto,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(producto $producto)
    {
        
        


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto= producto::find($id);
        if (is_null($producto)) {
           return response()->json(['message'=> 'Producto no encontrado'], 404);
        }
        $validateData=$request->validate([
            'nombre'=>'required|string|max:255',
            'precio'=>'required|max:255',
            'peso'=>'required|max:255',
            'stock'=>'required|integer',
            //'imagen'=>'required|mimes:jpeg,bmp,png',
            'id_categoria'=>'required',
            'id_marca'=>'required',
            'id_tipo_peso'=>'required',
        ]);
        $producto->nombre=$validateData['nombre'];
        $producto->precio=$validateData['precio'];
        $producto->peso=$validateData['peso'];
        $producto->stock=$validateData['stock'];
        $producto->id_categoria=$validateData['id_categoria'];
        $producto->id_marca=$validateData['id_marca'];
        $producto->id_tipo_peso=$validateData['id_tipo_peso'];
        $producto->save();
        return response()->json(['message'=>"Producto actualizado",200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto= producto::find($id);
        if (is_null($producto)) {
           return response()->json(['message'=> 'Producto no encontrado'], 404);
        }
        $producto->estado=0;
        $producto->save();
        return response()->json(['message' => 'Estado actualizado'], 201);

    }

    public function editImagen(Request $request, $id)
    {
        $producto= producto::find($id);
        if (is_null($producto)) {
           return response()->json(['message'=> 'Producto no encontrado'], 404);
        }
        $validateData = $request->validate([
            'imagen' => 'required|mimes:jpeg,bmp,png',
        ]);
        $img=$request->file('imagen');
        $validateData['imagen'] = time().'.'.$img->getClientOriginalExtension();
        $request->file('imagen')->storeAs("public/images/producto/{$producto->id}", $validateData['imagen']);
        $producto->imagen=$validateData['imagen'];
        $producto->save();
        return response()->json(['message' => 'Foto actualizada'], 201);
    }
    public function editPrecio(Request $request, $id)
    {
        $producto= producto::find($id);
        if (is_null($producto)) {
           return response()->json(['message'=> 'Producto no encontrado'], 404);
        }
        $validateData = $request->validate([
            'precio' => 'required',
        ]);
        $producto->precio = $validateData['precio'];
        $producto->save();
        return response()->json(['message' => 'Precio actualizado'], 201);
    }

    public function editStock(Request $request, $id)
    {
        $producto= producto::find($id);
        if (is_null($producto)) {
           return response()->json(['message'=> 'Producto no encontrado'], 404);
        }
        $validateData = $request->validate([
            'stock' => 'required',
        ]);
        $producto->stock = $validateData['stock'];
        $producto->save();
        return response()->json(['message' => 'Stock actualizado'], 201);
    }
}
