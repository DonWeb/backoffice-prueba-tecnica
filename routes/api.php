<?php

use App\Http\Controllers\Api\V1\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('v1/categories', App\Http\Controllers\Api\V1\CategoryController::class)->only('index');

Route::group(['prefix' => 'v1'], function () {
    Route::get('productos/{idCategoria?}', [ProductController::class, 'getProductos']);
});
