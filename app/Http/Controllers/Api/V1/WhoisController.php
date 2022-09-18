<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhoisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($domain=null){

        if($domain=='help'){
            return $this->help();
        }

        if($domain==null){
            return [
                "error"=>"No se ha pasado ningun dominio"
            ];
        }

        $res = Http::withHeaders([
            'Authorization' => 'Bearer '.env('TOKEN_WHOISJSONAPI'),
        ])->get('https://whoisjsonapi.com/v1/'.$domain);

        if ($res->getStatusCode() == 200) {
            $response_data = $res->object();
            $response_data = $response_data->domain->name_servers;
        }else{
            return $response_data = "Error: " . $res->getStatusCode();
        }

        return $response_data;
    }

    /**
     * Simple funcion de ayuda que devuelve metodos y parametros disponibles
     */
    private function help(){
        return [
            "example"=> url('/').'/api/v1/whois/andes3d.com',
            "info"=>'pasar el dominio para buscar el nameservers'
        ];
    }
}
