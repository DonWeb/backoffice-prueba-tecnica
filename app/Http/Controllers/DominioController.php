<?php

namespace App\Http\Controllers;

use App\Http\Requests\DominioRequest;
use App\Services\NameServersServices;

class DominioController extends Controller
{
    public function getNameServer(DominioRequest $request, NameServersServices $ns)
    {
        $data = $request->validated();

        $nameServers = $ns->getNameServers($data);

        return view('welcome', compact('nameServers'));
    }
}
