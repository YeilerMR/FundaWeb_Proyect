<?php

use App\Http\Controllers\Admin\CommerceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Landing\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('landing.home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn() => view('admin.dashboard.index'))->name('dashboard');
    Route::resource('slider', SliderController::class)->names('slider');

    Route::resource('commerce', CommerceController::class)->names('commerce');
});
