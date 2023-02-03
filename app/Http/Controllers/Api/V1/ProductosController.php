<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
  /**
   * Displays product list with optional id.
   *
   * @param  App\Http\Api\getProductos $request
   * @return \Illuminate\Http\Response
   */
  public function index($idCategoria = null)
  {
    if ($idCategoria) return Product::find($idCategoria);
    else return Product::all();
  }
}
