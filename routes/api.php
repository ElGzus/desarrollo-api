<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ValoracionController;

Route::middleware('auth:api')->group(function () {

    // Ruta para gestion de usuarios
    Route::get('usuarios', [UsuarioController::class, 'index']);
    Route::post('usuarios', [UsuarioController::class, 'store']);
    Route::get('usuarios/{id}', [UsuarioController::class, 'show']);
    Route::put('usuarios/{id}', [UsuarioController::class, 'update']);
    Route::delete('usuarios/{id}', [UsuarioController::class, 'delete']);

    // Rutas para gestionar productos
    Route::get('productos', [ProductController::class, 'index']);
    Route::post('productos', [ProductController::class,'store']);
    Route::get('productos/{id}', [ProductController::class,'show']);
    Route::put('productos/{id}', [ProductController::class, 'update']);
    Route::delete('productos/{id}', [ProductController::class, 'delete']);

    //Rutas para valoraciones
    Route::post('productos/{id}/valoracion', [ValoracionController::class, 'store']);
    Route::get('productos/{id}/valoracion', [ValoracionController::class, 'index']);
    Route::get('productos/{id}/valoracion-promedio', [ValoracionController::class, 'valoracionPromedio']);
    Route::get('productos/top-rated-valoracion', [ValoracionController::class, 'topRatedValoracion']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
