<?php

use App\Http\Controllers\AutoCompleteSearchController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('layouts.app');
});

Route::get('auto-complete-search', [AutoCompleteSearchController::class, 'index'])->name('auto-complete-search');
