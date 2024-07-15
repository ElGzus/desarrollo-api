<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ValoracionController;

Route::middleware('auth:api')->group(function () {

    // Ruta para gestion de usuarios
    Route::get('usuarios', [UsuarioController::class, 'index']);
    Route::post('usuarios', [UsuarioController::class, 'store']);
    Route::get('usuarios/{id}', [UsuarioController::class, 'show']);
    Route::put('usuarios/{id}', [UsuarioController::class, 'update']);
    Route::delete('usuarios/{id}', [UsuarioController::class, 'delete']);

    // Rutas para gestionar productos
    Route::get('productos', [ProductoController::class, 'index']);
    Route::post('productos', [ProductoController::class,'store']);
    Route::get('productos/{id}', [ProductoController::class,'show']);
    Route::put('productos/{id}', [ProductoController::class, 'update']);
    Route::delete('productos/{id}', [ProductoController::class, 'destroy']);

    //Rutas para valoraciones
    Route::post('productos/{id}/valoracion', [ValoracionController::class, 'store']);
    Route::get('productos/{id}/valoracion', [ValoracionController::class, 'index']);
    Route::get('productos/{id}/valoracion-promedio', [ValoracionController::class, 'valoracionPromedio']);
    Route::get('productos/top-rated-valoracion', [ValoracionController::class, 'topRatedValoracion']);

    // Ruta para cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Rutas para autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
