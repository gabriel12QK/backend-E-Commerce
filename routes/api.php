<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;

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

Route::post('/registro', [UserController::class, 'register']);
Route::post('/update-email/{id}', [UserController::class, 'editUserEmail']);
Route::post('/update-password/{id}', [UserController::class, 'editPassword']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/show', [UserController::class, 'index']);
Route::resource('producto', ProductoController::class);
Route::post('/edit-precio/{id}',[ ProductoController::class,'editPrecio']);
Route::post('/edit-stock/{id}',[ ProductoController::class,'editStock']);
Route::post('/edit-imagen/{id}',[ ProductoController::class,'editImagen']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
