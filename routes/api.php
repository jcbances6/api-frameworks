<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;

Route::prefix('v1')->group(function () {

    Route::post('login', [AuthController::class, 'login']);

    Route::get('products/find-by-name', [ProductController::class, 'findByName']);
    
    Route::middleware('auth:sanctum')->group(function () {
        // Route::get('user', function (Request $request) {
            //     return $request->user();
            // });
        Route::post('logout', [AuthController::class, 'logout']);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('products', ProductController::class);
    });







});
