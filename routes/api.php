<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('v1/categories', App\Http\Controllers\Api\V1\CategoryController::class)->only('index');

Route::apiResource('v1/products/{category?}',
    App\Http\Controllers\Api\V1\ProductController::class)->only('index');
