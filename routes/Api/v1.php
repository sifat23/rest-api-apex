<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

/**
 * api middleware
 */
Route::group(['middleware' => 'api'], function () {

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

    /**
     * product
     * admin middleware
    */
    Route::group(['middleware' => 'admin'], function () {
        Route::post('/product/store', [ProductController::class, 'store']);
        Route::post('/product/update/{product}', [ProductController::class, 'update']);
    });
});


