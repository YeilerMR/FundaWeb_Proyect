<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SliderController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', fn() => view('admin.dashboard.index'))->name('dashboard');
    Route::resource('slider', SliderController::class)->names('slider');
});