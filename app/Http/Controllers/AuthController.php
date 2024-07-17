<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try{
            // Validar los datos, dandoles parámetros de validación buit-in de Laravel
            $request->validate([
                'nombre' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:usuarios',
                'password' => 'required|string|min:8'
            ]);

            $user = Usuario::create([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'message' => 'Usuario registrado correctamente',
            ], 201);
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }

        $user = $request->user();

        // Se crea un token de autenticación para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'type' => 'Bearer',
            'message' => 'Usuario autenticado correctamente'
        ], 200);
    }

    public function logout(Request $request)
    {
        try {
            // Se revoca el token de autenticación del usuario
            $request->user()->currentAccessToken()->delete();
    
            return response()->json([
                'message' => 'Token de autenticación revocado'
            ], 200);
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }
}
