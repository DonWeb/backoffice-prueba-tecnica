<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Service\Whois\WhoisService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class WhoisQueryController extends Controller
{
    public function index(Request $request, WhoisService $whoisService): JsonResponse
    {
        $whoisServer = 'whois.donweb.com';
        $domain = $request->get('domain');
        $queryResult = $whoisService->makeQuery($whoisServer, $domain);
        return response()->json($queryResult);
    }
}
