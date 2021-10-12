<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    App::setLocale('en');
    return view('welcome');
});


Route::post('language', function () {
    App::setLocale(request()->lan);
    return back();
})->name('language');
