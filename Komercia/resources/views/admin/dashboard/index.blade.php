@extends('admin.layouts.master')

@section('title', 'Dashboard | Komercia')
@section('menu_dashboard', 'active')

@section('content')
    <div class="container-fluid py-3 py-md-4">

        <!-- Page Heading -->
        <div class="d-flex align-items-center justify-content-between mb-3 mb-md-4">
            <h1 class="h3 m-0 text-dark-emphasis page-title">Dashboard</h1>
        </div>

        <!-- Row 1: Estadísticas -->
        <div class="row g-3 g-md-4">
            <!-- Comercios -->
            <div class="col-12 col-sm-6 col-lg-3">
                <section class="card-surface d-flex justify-content-between align-items-start">
                    <div>
                        <p class="stat-title">Comercios</p>
                        <h2 class="stat-value">{{ $totalCommerces }}</h2>
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
                        <h2 class="stat-value">{{ $totalCategories }}</h2>
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
                        <h2 class="stat-value">{{ $totalProducts }}</h2>
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
                        <h2 class="stat-value">{{ $totalSliders }}</h2>
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

                    @forelse($recentCommerces as $commerce)
                        <div class="comercio-item d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="fw-semibold mb-1">{{ $commerce->dsc_nombre }}</h6>
                                <span class="comercio-category">
                                    <i class="bi bi-tag"></i>
                                    {{ $commerce->categories->first()->dsc_nombre ?? 'Sin categoría' }}
                                </span>
                            </div>
                            <span class="text-secondary small">
                                {{ $commerce->created_at ? $commerce->created_at->format('Y-m-d') : '—' }}
                            </span>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No hay comercios registrados aún.</p>
                    @endforelse
                </section>
            </div>

            <!-- Comercios por Categoría -->
            <div class="col-12 col-lg-8">
                <section class="card-surface p-3 p-md-4 h-100">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="stat-icon icon-blue"><i class="bi bi-graph-up"></i></div>
                        <h5 class="m-0 fw-semibold">Comercios por Categoría</h5>
                    </div>

                    @php
                        $maxCommerces = $commercesByCategory->max('commerces_count') ?: 1;
                        $colors = [
                            'rgba(255,107,53,0.9)',
                            'rgba(0,78,137,0.9)',
                            'rgba(0,173,123,0.9)',
                            'rgba(230,210,60,0.9)',
                            'rgba(136,84,208,0.9)',
                        ];
                    @endphp

                    <div id="categoryList" class="category-list mt-3">
                        @forelse ($commercesByCategory as $index => $cat)
                            @php
                                $percentage = ($cat->commerces_count / $maxCommerces) * 100;
                                $color = $colors[$loop->index % count($colors)];
                            @endphp

                            <div class="category-item mb-3 {{ $index >= 5 ? 'd-none extra-category' : '' }}">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-semibold text-dark">{{ $cat->dsc_nombre }}</span>
                                    <span class="fw-semibold text-secondary">{{ $cat->commerces_count }}</span>
                                </div>
                                <div class="progress position-relative" style="height: 10px;">
                                    <div class="progress-bar"
                                        style="width: {{ $percentage }}%; background-color: {{ $color }};">
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No hay categorías registradas aún.</p>
                        @endforelse
                    </div>

                    @if ($commercesByCategory->count() > 5)
                        <div class="text-center mt-3">
                            <button id="toggleCategories" class="btn btn-light btn-sm rounded-pill px-3">
                                Ver más
                            </button>
                        </div>
                    @endif
                </section>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            const $btn = $('#toggleCategories');
            const $extra = $('.extra-category');

            if ($btn.length) {
                $btn.on('click', function() {
                    const isExpanded = $btn.text() === 'Ver menos';
                    $extra.toggleClass('d-none', isExpanded);
                    $btn.text(isExpanded ? 'Ver más' : 'Ver menos');
                });
            }
        });
    </script>
@endpush