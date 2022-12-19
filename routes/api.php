<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PromocionProductoController;
use App\Http\Controllers\OrdenController;

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
Route::get('/user-index', [UserController::class, 'index']);
Route::get('/show/{id}', [UserController::class, 'Show']);
//repartidor
Route::post('/registro-repartidor', [UserController::class, 'registerRepartidor']);

// orden - pedido
Route::get('/show-orden-estado', [OrdenController::class, 'ShowOrdenEstado']);

//producto
Route::resource('producto', ProductoController::class);
Route::post('/edit-precio/{id}',[ ProductoController::class,'editPrecio']);
Route::post('/edit-stock/{id}',[ ProductoController::class,'editStock']);
Route::post('/edit-imagen/{id}',[ ProductoController::class,'editImagen']);

//categoria
Route::resource('categoria', CategoriaController::class);

//promocion producto
Route::resource('promocion-producto',PromocionProductoController::class);

//marca
Route::resource('marca', MarcaController::class);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
