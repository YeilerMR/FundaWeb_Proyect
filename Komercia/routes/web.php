<?php

use App\Http\Controllers\Admin\CommerceController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Admin\ControllerCategory;

Route::get('/', [LandingController::class, 'index'])->name('landing.home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn() => view('admin.dashboard.index'))->name('dashboard');
    Route::resource('slider', SliderController::class)->names('slider');

    Route::resource('commerce', CommerceController::class)->names('commerce');
    Route::get('commerce/{commerce}/gallery', [CommerceController::class, 'gallery'])
        ->name('commerce.gallery');
    Route::post('commerce/{commerce}/gallery', [CommerceController::class, 'galleryStore'])
        ->name('commerce.gallery.store');
        
    Route::resource('category', ControllerCategory::class)->names('category');
});
