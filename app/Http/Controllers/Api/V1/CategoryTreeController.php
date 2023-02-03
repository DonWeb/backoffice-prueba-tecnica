<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryTreeController extends Controller
{
  /**
   * Display a tree of categories and subcategories.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $result = DB::select(
      "WITH RECURSIVE category_path (id, path) AS
      (
        SELECT id, nombre as path
          FROM categories
          WHERE idcategoriapadre IS NULL
        UNION ALL
        SELECT c.id, cp.path || ' -> ' || c.nombre
          FROM category_path AS cp JOIN categories AS c
            ON cp.id = c.idcategoriapadre
      )
      SELECT * FROM category_path"
    );
    // Reemplazar "cp.path || ' -> ' || c.nombre" por
    // CONCAT(cp.path, ' -> ', c.nombre)  para usar con MySQL
    return $result;
  }
}
