<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Display a listing of categories and subcategories.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubcategories()
    {

            $categoriesAll= DB::select("select a.nombre as Nivel1, b.nombre as Nivel2, c.nombre as Nivel3 
            from categories a 
            INNER JOIN categories b ON a.id = b.idcategoriapadre 
            LEFT JOIN categories c ON b.id = c.idcategoriapadre
            WHERE a.idcategoriapadre IS NULL
            ORDER BY a.nombre, b.nombre, c.nombre");

            return view('categories.subcategories', ['categoriesAll' => $categoriesAll]);
            
    }
}
