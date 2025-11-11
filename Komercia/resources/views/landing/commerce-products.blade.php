@extends('landing.layouts.master')

@section('title', $commerce->dsc_nombre . ' - Productos | Komercia')

@push('styles')
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/comercio_detalle.css') }}">
@endpush

@section('content')
<!-- SEARCHER -->
@include('landing.partials.search', ['q' => request('q')])

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
                <li class="breadcrumb-item active" aria-current="page">Productos</li>
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
                <a class="nav-link active" href="{{ route('landing.commerce.products', $commerce->id_comercio) }}">Productos</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{route('landing.commerce.gallery', $commerce->id_comercio)}}">Galería</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('landing.commerce.contact', $commerce->id_comercio) }}">Contacto</a></li>
        </ul>

        <!-- Main Content -->
        <div class="row product-info mb-5">
            <div class="col-12">
                <h5 class="fw-bold mb-4" data-aos="fade-up" data-aos-delay="250">Productos y Servicios</h5>

                @if($products->isEmpty())
                    <div class="col-12 text-center py-5">
                        <p>Este comercio aún no tiene productos registrados.</p>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($products as $product)
                            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 + 300 }}">
                                <div class="product-card">
                                    <div class="product-image">
                                        <img src="{{ asset($product->dsc_imagen_destacada ?? 'images/default-product.jpg') }}"
                                             alt="{{ $product->dsc_nombre }}"
                                             class="img-fluid">
                                    </div>
                                    <div class="product-body">
                                        <h6 class="product-title">{{ $product->dsc_nombre }}</h6>
                                        <p class="product-price">${{ number_format($product->precio, 2) }}</p>
                                        <a href="#" class="btn btn-product">Ver más</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection