<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\UserCheckController;
use App\Http\Controllers\AutoCompleteSearchController;


Route::get('/', function () {
    return view('layouts.app');
});

# Auto Complete Search

Route::controller(AutoCompleteSearchController::class)->prefix('auto-complete-search')->name('auto-complete-search')->group(function () {

    Route::get('/', 'index');
    Route::post('/data', 'getSearchData')->name('.data');
});


# User check exits

Route::prefix('user-check')->controller(UserCheckController::class)->name('user-check')->group(function () {
    Route::get('/', 'index');
    Route::post('/data', 'checkUserExistsOrNot')->name('.data');
});


Route::controller(CrudController::class)->name('crud.')->prefix('crud')->group(function () {

    Route::get('get-all-data', 'getAllData')->name('get-all-data');
    Route::get('/', 'index')->name('index');
    Route::post('store', 'store')->name('store');
    Route::delete('{crud}', 'destroy')->name('destroy');
    Route::get('{crud}', 'show')->name('view');

    Route::post('{crud}', 'update')->name('update');
});
