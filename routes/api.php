<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:api')->group(function () {
    Route::get('usuarios', [UsuarioController::class, 'index']);
    Route::post('usuarios', [UsuarioController::class, 'store']);
    Route::get('usuarios/{id}', [UsuarioController::class, 'show']);
    Route::put('usuarios/{id}', [UsuarioController::class, 'update']);
    Route::delete('usuarios/{id}', [UsuarioController::class, 'delete']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
