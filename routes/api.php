<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('v1/categories', App\Http\Controllers\Api\V1\CategoryController::class)->only('index');

Route::apiResource('v1/products', App\Http\Controllers\Api\V1\ProductController::class)
    ->only('index');
