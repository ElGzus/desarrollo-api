<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Valoracion;
use Illuminate\Http\Request;

class ValoracionController extends Controller
{
    public function index($productoId)
    {
        $producto = Producto::findOrFail($productoId);
        return $producto->reviews;
    }

    public function store(Request $request, $productoId)
    {
        $producto = Producto::findOrFail($productoId);
        $valoracion = new Valoracion($request->all());
        $valoracion->producto_id = $productoId;
        $valoracion->save();

        return response()->json($valoracion, 201);
    }

    public function valoracionPromedio($productoId)
    {
        $producto = Producto::findOrFail($productoId);
        $averageRating = $producto->valoraciones->avg('puntuacion');
        return response()->json(['valoracion_promedio' => $averageRating], 200);
    }

    public function topRatedValoracion()
    {
        $topRatedProductos = Producto::with('valoraciones')
            ->orderBy('valoraciones_count', 'desc')
            ->limit(5)
            ->get();

        return response()->json($topRatedProductos, 200);
    }
}
