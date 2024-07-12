<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::all();
    }

    public function store(Request $request)
    {
        $usuario = Usuario::create($request->all());
        return response()->json($usuario, 201);
    }

    public function show($id)
    {
        return Usuario::find($id);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());
        return response()->json($usuario, 200);
    }

    public function delete($id)
    {
        Usuario::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
