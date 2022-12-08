<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\ProductsService;


class ProductController extends Controller
{
    public function index($category = 0)
    {
        return (new ProductsService())->getByCategory($category);
    }

}

