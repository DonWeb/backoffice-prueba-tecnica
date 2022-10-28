<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function getProductos(int $idCategoria = null)
    {
        $products = Product::with('category')
            ->when(! is_null($idCategoria), function ($query) use ($idCategoria) {
                $query->where('category_id', $idCategoria);
            })->get();

        $data = $products->map(function ($product) {
            return [
                'producto_nombre' => $product->descripcion,
                'producto_precio' => $product->precio,
                'producto_categoria' => [
                    'categoria_nombre' => $product->category?->nombre,
                ],
            ];
        });

        return response()->json($data);
    }
}
