<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Admin\ControllerCategory;

Route::get('/', [LandingController::class, 'index'])->name('landing.home');
Route::get('/comercios', [LandingController::class, 'commerces'])->name('landing.commerces');
Route::get('/comercios/categoria/{id}', [LandingController::class, 'commercesByCategory'])->name('landing.commerces.category');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn() => view('admin.dashboard.index'))->name('dashboard');
    Route::resource('slider', SliderController::class)->names('slider');
    Route::resource('category', ControllerCategory::class)->names('category');
});



