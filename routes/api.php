<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$controllerApi = "App\Http\Controllers\Api\V1\\";

Route::apiResource('v1/categories', $controllerApi.CategoryController::class)->only('index');

# Agrega metodo nuevo para products
Route::apiResource('v1/products/{tipo?}/{id?}', $controllerApi.ProductController::class)->only('index');

# Invento de whois con una api ya que ws no me estaria funcionando
Route::apiResource('v1/whois/{domain?}', $controllerApi.WhoisController::class)->only('index');
