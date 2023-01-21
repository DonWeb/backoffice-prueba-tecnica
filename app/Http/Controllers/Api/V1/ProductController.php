<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Display the specified resource.
     *
     * @param int $idCategoria
     * @return \Illuminate\Http\Response
     */
    public function getProductos($idCategoria)
    {
        return Product::where("category_id","=",$idCategoria)->get();
    }
}
