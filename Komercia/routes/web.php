<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CommerceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ControllerCategory;


// RUTAS PÚBLICAS
Route::get('/', [LandingController::class, 'index'])->name('landing.home');


// PANEL ADMINISTRATIVOF
Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', fn() => view('admin.dashboard.index'))->name('dashboard');
    // SLIDER
    Route::resource('slider', SliderController::class)->names('slider');
    // COMERCIOS
    Route::resource('commerce', CommerceController::class)->names('commerce');
    // GALERÍA DE COMERCIOS
    Route::get('commerce/{commerce}/gallery', [CommerceController::class, 'gallery'])
        ->name('commerce.gallery');
    Route::post('commerce/{commerce}/gallery', [CommerceController::class, 'galleryStore'])
        ->name('commerce.gallery.store');
    // PRODUCTOS DE UN COMERCIO
    Route::get('commerce/{commerce}/products', [ProductController::class, 'index'])
        ->name('commerce.products.index');
    Route::get('commerce/{commerce}/products/create', [ProductController::class, 'create'])
        ->name('commerce.products.create');
    Route::post('commerce/{commerce}/products', [ProductController::class, 'store'])
        ->name('commerce.products.store');
    // PRODUCTOS (RESTO DE ACCIONES)
    Route::resource('product', ProductController::class)
        ->only(['edit', 'update', 'destroy'])
        ->names('product');
    // GALERÍA DE PRODUCTOS
    Route::get('product/{product}/gallery', [ProductController::class, 'gallery'])
        ->name('product.gallery');
    Route::post('product/{product}/gallery', [ProductController::class, 'galleryStore'])
        ->name('product.gallery.store');
    // CATEGORÍAS
    Route::resource('category', ControllerCategory::class)->names('category');
});
