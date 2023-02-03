<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource(
  'v1/categories',
  App\Http\Controllers\Api\V1\CategoryController::class
)->only('index');

Route::apiResource(
  'v1/categoryTree',
  App\Http\Controllers\Api\V1\CategoryTreeController::class
)->only('index');

Route::apiResource(
  'v1/getProductos/{idCategoria?}',
  App\Http\Controllers\Api\V1\ProductosController::class
)->only('index');

Route::apiResource(
  'v1/nameServer/{domain?}',
  App\Http\Controllers\Api\V1\NamesByDomain::class
)->only('index');