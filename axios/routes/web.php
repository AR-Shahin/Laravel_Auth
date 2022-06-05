<?php

use App\Http\Controllers\AutoCompleteSearchController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('layouts.app');
});

# Auto Complete Search

Route::controller(AutoCompleteSearchController::class)->prefix('auto-complete-search')->name('auto-complete-search')->group(function () {

    Route::get('/', 'index');
    Route::post('/data', 'getSearchData')->name('.data');
});
