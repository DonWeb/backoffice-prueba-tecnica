<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repository\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, ProductRepository $productRepository): JsonResponse
    {
        $categoryId = $request->get('idCategory');
        $products = $productRepository->findProducts($categoryId);
        return response()->json($products);
    }
}