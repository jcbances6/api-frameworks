<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;

Route::prefix('v1')->group(function () {
    Route::apiResource('categories', CategoryController::class);

    Route::get('products/find-by-name', [ProductController::class, 'findByName']);

    Route::apiResource('products', ProductController::class);

});
