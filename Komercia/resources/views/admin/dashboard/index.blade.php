@extends('admin.layouts.master')

@section('title', 'Dashboard | Komercia')

{{-- Activar item de menú --}}
@section('menu_dashboard', 'active')

@section('content')

    <div class="container-fluid py-3 py-md-4">

        <!-- Page Heading -->
        <div class="d-flex align-items-center justify-content-between mb-3 mb-md-4">
            <h1 class="h3 m-0 text-dark-emphasis page-title">Dashboard</h1>
        </div>

        <!-- Row 1: (stats) -->
        <div class="row g-3 g-md-4">

            <!-- Comercios -->
            <div class="col-12 col-sm-6 col-lg-3">
                <section class="card-surface d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stat-title">Comercios</p>
                        <h2 class="stat-value">156</h2>
                    </div>
                    <div class="stat-icon icon-orange">
                        <i class="bi bi-shop"></i>
                    </div>
                </section>
            </div>

            <!-- Categorías -->
            <div class="col-12 col-sm-6 col-lg-3">
                <section class="card-surface d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stat-title">Categorías</p>
                        <h2 class="stat-value">24</h2>
                    </div>
                    <div class="stat-icon icon-blue">
                        <i class="bi bi-tag"></i>
                    </div>
                </section>
            </div>

            <!-- Productos -->
            <div class="col-12 col-sm-6 col-lg-3">
                <section class="card-surface d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stat-title">Productos</p>
                        <h2 class="stat-value">1248</h2>
                    </div>
                    <div class="stat-icon icon-green">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </section>
            </div>

            <!-- Slider -->
            <div class="col-12 col-sm-6 col-lg-3">
                <section class="card-surface d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stat-title">Slider</p>
                        <h2 class="stat-value">8</h2>
                    </div>
                    <div class="stat-icon icon-yellow">
                        <i class="bi bi-images"></i>
                    </div>
                </section>
            </div>
        </div>

        <!-- Row 2: Comercios recientes / por categoría -->
        <div class="row g-3 g-md-4 mt-1 mt-md-2">

            <!-- Comercios Recientes -->
            <div class="col-12 col-lg-4">
                <section class="card-surface p-3 p-md-4 h-100 text-start">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="stat-icon icon-orange"><i class="bi bi-buildings"></i></div>
                        <h5 class="m-0 fw-semibold">Comercios Recientes</h5>
                    </div>

                    <div class="comercio-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-semibold mb-1">Restaurante Crickesio</h6>
                            <span class="comercio-category"><i class="bi bi-cup-hot"></i> Restaurante</span>
                        </div>
                        <span class="text-secondary small">2024-01-15</span>
                    </div>

                    <div class="comercio-item d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="fw-semibold mb-1">Hotel El Cricko</h6>
                            <span class="comercio-category"><i class="bi bi-building"></i> Hotel</span>
                        </div>
                        <span class="text-secondary small">2024-01-14</span>
                    </div>

                    <div class="comercio-item d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="fw-semibold mb-1">Zapatería La Martha</h6>
                            <span class="comercio-category"><i class="bi bi-bag"></i> Zapatería</span>
                        </div>
                        <span class="text-secondary small">2024-01-13</span>
                    </div>

                    <div class="comercio-item d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="fw-semibold mb-1">Café Central</h6>
                            <span class="comercio-category"><i class="bi bi-cup-hot"></i> Restaurante</span>
                        </div>
                        <span class="text-secondary small">2024-01-12</span>
                    </div>

                    <div class="comercio-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-semibold mb-1">Tech Store</h6>
                            <span class="comercio-category"><i class="bi bi-laptop"></i> Tecnología</span>
                        </div>
                        <span class="text-secondary small">2024-01-11</span>
                    </div>
                </section>
            </div>

            <!-- Comercios por Categoría -->
            <div class="col-12 col-lg-8">
                <section class="card-surface p-3 p-md-4 h-100">
                    {{-- luego irá gráfico --}}
                </section>
            </div>
        </div>
    </div>

@endsection