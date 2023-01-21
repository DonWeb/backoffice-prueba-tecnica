<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('v1/categories', App\Http\Controllers\Api\V1\CategoryController::class)->only('index');
Route::get('v1/products/category/subcategories', [App\Http\Controllers\Api\V1\CategoryController::class, 'getSubcategories']);


Route::apiResource('v1/products/', App\Http\Controllers\Api\V1\ProductController::class)->only('index');
Route::apiResource('v1/products/category', App\Http\Controllers\Api\V1\ProductController::class)->only('index');
Route::get('v1/products/category/{idCategoria}', [App\Http\Controllers\Api\V1\ProductController::class, 'getProductos']);
