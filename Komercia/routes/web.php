<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CommerceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ControllerCategory;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// --------------------------------------------------------------------------
// RUTAS PÚBLICAS (DIRECTORIO COMERCIAL LANDING PAGE)
// --------------------------------------------------------------------------
Route::get('/', [LandingController::class, 'index'])->name('landing.home');
Route::get('/comercios', [LandingController::class, 'commerces'])->name('landing.commerces');
Route::get('/comercios/categoria/{id}', [LandingController::class, 'commercesByCategory'])->name('landing.commerces.category');
Route::get('/producto/{id}', [LandingController::class, 'showProduct'])->name('landing.product.show');
Route::get('/comercio/{id}', [LandingController::class, 'showCommerce'])->name('landing.commerce.show');
Route::get('/comercio/{id}/productos', [LandingController::class, 'showProducts'])->name('landing.commerce.products');
Route::get('/comercio/{id}/galeria', [LandingController::class, 'showGallery'])->name('landing.commerce.gallery');
Route::get('/comercio/{id}/contacto', [LandingController::class, 'showContact'])->name('landing.commerce.contact');
Route::post('/comercio/{id}/contacto', [LandingController::class, 'sendContact'])->name('landing.commerce.contact.send');
Route::get('/search', [LandingController::class, 'search'])->name('landing.search');

// --------------------------------------------------------------------------
// AUTENTICACIÓN (SOLO PARA ADMINISTRADORES)
// --------------------------------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Ruta especial para crear administradores durante desarrollo
if (app()->environment('local')) {
    Route::get('/register-admin', [AuthenticatedSessionController::class, 'register']);
}

// --------------------------------------------------
// RUTAS PANEL ADMINISTRATIVO (PROTEGIDO)
// --------------------------------------------------
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
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


// --------------------------------------------------
// PREVIEW DE EMAIL (TESTING EMAIL)
// --------------------------------------------------
Route::get('/preview/email-contacto', function () {
    $data = [
        'commerce_name' => 'Café Aroma',
        'dsc_nombre' => 'Juan Pérez',
        'dsc_telefono' => '8888-8888',
        'dsc_correo' => 'juanperez@mail.com',
        'dsc_mensaje' => 'Hola, estoy interesado en conocer más sobre sus servicios.'
    ];

    return view('emails.contact-message', ['data' => $data]);
});
