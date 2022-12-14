<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PromocionProductoController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\TipoPesoController;
use App\Http\Controllers\RegistroPromocionController;
use App\Http\Controllers\TipoPromocionController;
use App\Http\Controllers\KitController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//usuario
Route::post('/registro', [UserController::class, 'register']);
Route::post('/update-email/{id}', [UserController::class, 'editUserEmail']);
Route::post('/update-password/{id}', [UserController::class, 'editPassword']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/imagen-update/{id}', [UserController::class, 'updateImage']);
Route::post('/usuario-update/{id}', [UserController::class, 'updateUser']);
Route::get('/user-index', [UserController::class, 'index']);
Route::get('/show/{id}', [UserController::class, 'Show']);
Route::delete('/delete-usuario/{id}', [UserController::class, 'destroy']); //sirve para eliminar usuarios normales y repartidores
Route::get('/getAllUsuarios', [UserController::class, 'getAllUsuarios']);
//repartidor
Route::post('/registro-repartidor', [UserController::class, 'registerRepartidor']);
Route::get('/getAllRepartidores', [UserController::class, 'getAllRepartidores']);



// orden - pedido
Route::get('/show-orden-estado', [OrdenController::class, 'ShowOrdenEstado']);
Route::resource('orden', OrdenController::class);

//producto
Route::resource('producto', ProductoController::class);
Route::post('/edit-precio/{id}',[ ProductoController::class,'editPrecio']);
Route::post('/edit-stock/{id}',[ ProductoController::class,'editStock']);
Route::post('/edit-imagen/{id}',[ ProductoController::class,'editImagen']);
Route::get('showProducto/{id}',[ProductoController::class,'showProducto']);
Route::get('showProductoMarca/{id}',[ProductoController::class,'showProductoMarca']);
Route::get('showProductoCategoria/{id}',[ProductoController::class,'showProductoCategoria']);

//venta
Route::resource('venta', VentaController::class);
Route::get('/show-venta', [VentaController::class, 'ShowVenta']);
Route::get('/show-ventaPersona/{id}', [VentaController::class, 'showVentaPersona']);

//tipo peso
Route::resource('tipo_peso', TipoPesoController::class);

//categoria
Route::resource('categoria', CategoriaController::class);
Route::post('edit-img-categoria/{id}', [CategoriaController::class, 'editImagen']);

//promocion producto
Route::resource('promocion-producto', PromocionProductoController::class);
Route::get('showPromocion/{id}',[PromocionProductoController::class,'showPromocionProducto']);
Route::get('indexPromocion',[PromocionProductoController::class,'PromocionProducto']);

//marca
Route::resource('marca', MarcaController::class);
Route::post('edit-img-marca/{id}', [MarcaController::class, 'editImagen']);

//tipo promocion
Route::resource('tipo-promocion', TipoPromocionController::class);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/showOfertasKits', [KitController::class,'showOfertasKits']);

