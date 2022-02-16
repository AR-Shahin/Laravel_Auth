<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->controller(ProductController::class)->group(function () {
    Route::middleware('auth:admin_api')->group(function () {
        Route::post('/', 'store');
        Route::post('update/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });

    Route::middleware('auth:customer_api')->group(function () {
        Route::get('/', 'getAllProduct');
        Route::get('/{id}', 'show');
    });
});


Route::prefix('admin')->controller(AuthController::class)->group(function () {

    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::middleware('auth:admin_api')->group(function () {
        Route::post('logout', 'logout');
        Route::post('me', 'me');
    });
});

Route::prefix('customer')->controller(CustomerAuthController::class)->group(function () {

    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::middleware('auth:admin_api')->group(function () {
        Route::post('logout', 'logout');
        Route::post('me', 'me');
    });
});
