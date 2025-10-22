<?php

use App\Http\Controllers\ControllerCategory;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/category', ControllerCategory::class);

