@extends('landing.layouts.master')

@section('title', $product->dsc_nombre . ' | ' . ($commerce->dsc_nombre ?? 'Komercia'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/libs/fancybox/jquery.fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/comercio_detalle.css') }}">
@endpush

@section('content')

    {{-- BUSCADOR GLOBAL --}}
    @include('landing.partials.search', ['q' => request('q')])

    <!-- PRODUCT DETAIL -->
    <section class="detail-section py-5">
        <div class="container">
            <div class="product-header mb-2">
                <button class="btn-back" onclick="window.history.back()" data-aos="fade-up" data-aos-delay="100">
                    <i class="bi bi-arrow-left-circle me-1"></i> Regresar
                </button>
                <h1 class="fw-bold mb-0 text-uppercase product-title" data-aos="fade-up" data-aos-delay="150">
                    {{ $product->dsc_nombre }}
                </h1>
            </div>

            <!-- BREADCRUMB -->
            <nav aria-label="breadcrumb" class="mb-5" data-aos="fade-up" data-aos-delay="200">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item"><a href="{{ route('landing.home') }}">Inicio</a></li>
                    @if ($commerce && $commerce->categories->first())
                        <li class="breadcrumb-item">
                            <a
                                href="{{ route('landing.commerces.category', $commerce->categories->first()->id_categoria) }}">
                                {{ $commerce->categories->first()->dsc_nombre }}
                            </a>
                        </li>
                    @endif
                    <li class="breadcrumb-item">
                        <a
                            href="{{ route('landing.commerce.show', $commerce->id_comercio) }}">{{ $commerce->dsc_nombre }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('landing.commerce.products', $commerce->id_comercio) }}">Productos</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->dsc_nombre }}</li>
                </ol>
            </nav>

            <!-- CONTENIDO PRINCIPAL -->
            <div class="row align-items-start mb-5 gy-4">
                <!-- Imagen Principal -->
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="250">
                    <div class="main-img-container">
                        <img src="{{ asset($product->dsc_imagen_destacada ?? 'images/default-product.jpg') }}"
                            alt="{{ $product->dsc_nombre }}" class="main-img">
                    </div>
                </div>

                <!-- Descripción -->
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="300">
                    <h4 class="fw-bold mb-3">Descripción</h4>
                    <p>{{ $product->dsc_descripcion ?? 'No hay descripción disponible.' }}</p>

                    <p><strong>Precio:</strong> ₡{{ number_format($product->precio ?? 0, 2, ',', '.') }}</p>

                    @if ($commerce)
                        <p><strong>Comercio:</strong>
                            <a href="{{ route('landing.commerce.show', $commerce->id_comercio) }}"
                                class="text-decoration-none">
                                {{ $commerce->dsc_nombre }}
                            </a>
                        </p>
                    @endif
                </div>
            </div>

            <!-- GALERÍA -->
            @if ($product->images && $product->images->count() > 0)
                <div class="gallery-section" data-aos="fade-up" data-aos-delay="400">
                    <h5 class="fw-bold mb-4">Galería de Imágenes</h5>
                    <div class="row g-3">
                        @foreach ($product->images as $index => $image)
                            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up"
                                data-aos-delay="{{ 300 + $index * 50 }}">
                                <a data-fancybox="galeria" data-caption="{{ $product->dsc_nombre }}"
                                    href="{{ asset($image->ruta_imagen) }}">
                                    <div class="gallery-item">
                                        <img src="{{ asset($image->ruta_imagen) }}" alt="{{ $product->dsc_nombre }}"
                                            class="gallery-img">
                                        <div class="gallery-overlay">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('TemplateKomercia/assets/libs/fancybox/fancybox.umd.js') }}"></script>
@endpush