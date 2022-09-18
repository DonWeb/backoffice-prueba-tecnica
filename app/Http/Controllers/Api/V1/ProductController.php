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
    public function index($tipo=null,$id=null){
        switch ($tipo) {
            case "help":
                $result = $this->help();
                break;
            case "idCategory":
                $result = Product::where('category_id','=',$id)->get();
                break;
            case "idProduct" || is_numeric($tipo):
                if(is_numeric($tipo))
                    $id=$tipo;
                $result = Product::where('id','=',$id)->get();
                break;
            default:
                $result = Product::all();
                break;
        }

        if(count($result)==0){
            $result = Product::all();
        }

        return $result;
    }

    private function help(){
        return [
            "params"=>[
                'idCategory' => 'Retorna todos los produtos de una categoria',
                'idProduct' => 'Retorna un produto específico',
                'help' => 'Retorna una ayuda'
            ],
            "example"=>[
                'idCategory' => url('/').'/api/v1/products/idCategory/1',
                'idProduct' => url('/').'/api/v1/products/idProduct/1',
                'help' => url('/').'/api/v1/products/help'
            ],
            "info"=>'En caso de no encontrar o pasar algun parametro devolvera todos los productos'
        ];
    }
}
