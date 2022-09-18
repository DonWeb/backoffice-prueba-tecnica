<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$controllerApi = "App\Http\Controllers\Api\V1\\";

Route::apiResource('v1/categories', $controllerApi.CategoryController::class)->only('index');

# Agrega metodo nuevo para products
Route::apiResource('v1/products/{tipo?}/{id?}', $controllerApi.ProductController::class)->only('index');
