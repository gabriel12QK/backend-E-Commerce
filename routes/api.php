<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PromocionProductoController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\TipoPesoController;
use App\Http\Controllers\RegistroPromocionController;

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
//repartidor
Route::post('/registro-repartidor', [UserController::class, 'registerRepartidor']);

// orden - pedido
Route::get('/show-orden-estado', [OrdenController::class, 'ShowOrdenEstado']);
Route::resource('orden', OrdenController::class);

//producto
Route::resource('producto', ProductoController::class);
Route::post('/edit-precio/{id}',[ ProductoController::class,'editPrecio']);
Route::post('/edit-stock/{id}',[ ProductoController::class,'editStock']);
Route::post('/edit-imagen/{id}',[ ProductoController::class,'editImagen']);

//tipo peso
Route::resource('tipo_peso', TipoPesoController::class);

//categoria
Route::resource('categoria', CategoriaController::class);

//promocion producto
Route::resource('promocion-producto',PromocionProductoController::class);

//marca
Route::resource('marca', MarcaController::class);

//Registro promocion
Route::get('/kits/{id}',[RegistroPromocionController::class,'showPromocion']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
