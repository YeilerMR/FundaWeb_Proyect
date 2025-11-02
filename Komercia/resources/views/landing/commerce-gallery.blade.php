@extends('landing.layouts.master')

@section('title', $commerce->dsc_nombre . ' - Galería | Komercia')

@push('styles')
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/comercio_detalle.css') }}">
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/libs/fancybox/jquery.fancybox.css') }}">
@endpush

@section('content')
<!-- SEARCHER -->
<section class="search-section py-5" data-aos="fade-up">
    <div class="container">
        <div class="search-wrapper">
            <i class="bi bi-search search-icon-left"></i>
            <input type="text" class="form-control search-input" placeholder="Buscar comercios, productos o servicios...">
            <button class="btn btn-search"><i class="bi bi-arrow-right"></i></button>
        </div>
    </div>
</section>

<!-- DETALLE DEL COMERCIO -->
<section class="detail-section py-5">
    <div class="container">
        <h3 class="fw-bold mb-3" data-aos="fade-up">{{ $commerce->dsc_nombre }}</h3>

        <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-up" data-aos-delay="100">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('landing.home') }}">Inicio</a></li>
                @if($category)
                    <li class="breadcrumb-item">
                        <a href="{{ route('landing.commerces.category', $category->id_categoria) }}">
                            {{ $category->dsc_nombre }}
                        </a>
                    </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">Galería</li>
            </ol>
        </nav>

        <!-- Main Image -->
        <div class="mb-4" data-aos="fade-up" data-aos-delay="150">
            <div class="main-img-container">
                <img src="{{ asset($commerce->dsc_imagen_destacada ?? 'images/default-shop.jpg') }}"
                     alt="{{ $commerce->dsc_nombre }}" class="main-img">
            </div>
        </div>

        <!-- Tab navigation -->
        <ul class="nav nav-tabs mb-4" data-aos="fade-up" data-aos-delay="200">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('landing.commerce.show', $commerce->id_comercio) }}">Información</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('landing.commerce.products', $commerce->id_comercio) }}">Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('landing.commerce.gallery', $commerce->id_comercio) }}">Galería</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('landing.commerce.contact', $commerce->id_comercio) }}">Contacto</a></li>
            
        </ul>

        <!-- Galería -->
        <div class="row gallery-section mb-5">
            <div class="col-12">
                <h5 class="fw-bold mb-4" data-aos="fade-up" data-aos-delay="250">Galería de Imágenes</h5>
            </div>

            @if($images->isEmpty())
                <div class="col-12 text-center py-5">
                    <p>Este comercio aún no tiene imágenes en su galería.</p>
                </div>
            @else
                <div class="row g-3">
                    @foreach($images as $image)
                        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 + 300 }}">
                            <a data-fancybox="galeria" data-caption="{{ $image->dsc_alt }}"
                               href="{{ asset($image->dsc_url) }}">
                                <div class="gallery-item">
                                    <img src="{{ asset($image->dsc_url) }}"
                                         alt="{{ $image->dsc_alt }}"
                                         class="gallery-img">
                                    <div class="gallery-overlay">
                                        <i class="bi bi-zoom-in"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script src="{{ asset('TemplateKomercia/assets/libs/fancybox/fancybox.umd.js') }}"></script>
    <script>
        AOS.init();
    </script>
@endpush