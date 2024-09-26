<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

/**
 * api public routes
 */

Route::get('/all-products', [ProductController::class, 'allProducts']);

/**
 * authentication
 * auth prefix
 */
Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});

Route::group(['middleware' => 'auth:api'], function () {

    /**
     * product
     * admin middleware
    */
    Route::group(['middleware' => 'admin'], function () {
        Route::post('/product/store', [ProductController::class, 'store']);
        Route::post('/product/update/{product}', [ProductController::class, 'update']);
    });

    /**
     * orders
     * order items
     */
    Route::post('/order/place', [OrderController::class, 'orderPlace']);
    Route::get('/order/history', [OrderController::class, 'orderHistory']);
});


