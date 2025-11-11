@extends('landing.layouts.master')

@section('title', $commerce->dsc_nombre . ' | Komercia')

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
                    @if ($category)
                        <li class="breadcrumb-item">
                            <a href="{{ route('landing.commerces.category', $category->id_categoria) }}">
                                {{ $category->dsc_nombre }}
                            </a>
                        </li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">Información</li>
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
                    <a class="nav-link active"
                        href="{{ route('landing.commerce.show', $commerce->id_comercio) }}">Información</a>
                </li>
                <li class="nav-item"><a class="nav-link"
                        href="{{ route('landing.commerce.products', $commerce->id_comercio) }}">Productos</a></li>
                <li class="nav-item"><a class="nav-link"
                        href="{{ route('landing.commerce.gallery', $commerce->id_comercio) }}">Galería</a></li>
                <li class="nav-item"><a class="nav-link"
                        href="{{ route('landing.commerce.contact', $commerce->id_comercio) }}">Contacto</a></li>

            </ul>

            <!-- Main Content -->
            <div class="row contact-info mb-5">
                <div class="col-md-7">
                    <h5 class="fw-bold mb-3" data-aos="fade-up" data-aos-delay="250">Información</h5>
                    <p data-aos="fade-up" data-aos-delay="300">
                        {{ $commerce->dsc_descripcion ?: 'No hay descripción disponible.' }}
                    </p>

                    <div class="info-items">
                        {{-- Dirección --}}
                        @if ($commerce->dsc_direccion)
                            <div class="info-item" data-aos="fade-up" data-aos-delay="350">
                                <div class="info-icon"><i class="bi bi-geo-alt-fill"></i></div>
                                <div class="info-content">
                                    <strong>Dirección:</strong>
                                    <span>{{ $commerce->dsc_direccion }}</span>
                                </div>
                            </div>
                        @endif

                        {{-- Teléfonos --}}
                        @if ($commerce->phones->isNotEmpty())
                            <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                                <div class="info-icon"><i class="bi bi-telephone-fill"></i></div>
                                <div class="info-content">
                                    <strong>Teléfonos:</strong>
                                    <div class="contact-list">
                                        @foreach ($commerce->phones as $phone)
                                            <a href="tel:{{ preg_replace('/\s+/', '', $phone->dsc_telefono) }}"
                                                target="_blank" rel="noopener">
                                                {{ $phone->dsc_telefono }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Correos --}}
                        @if ($commerce->emails->isNotEmpty())
                            <div class="info-item" data-aos="fade-up" data-aos-delay="450">
                                <div class="info-icon"><i class="bi bi-envelope-fill"></i></div>
                                <div class="info-content">
                                    <strong>Correos:</strong>
                                    <div class="contact-list">
                                        @foreach ($commerce->emails as $email)
                                            <a href="mailto:{{ $email->dsc_correo }}" target="_blank" rel="noopener">
                                                {{ $email->dsc_correo }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Facebook --}}
                        @if ($commerce->dsc_facebook)
                            <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                                <div class="info-icon"><i class="bi bi-facebook"></i></div>
                                <div class="info-content">
                                    <strong>Facebook:</strong>
                                    @php
                                        $facebookUrl = Str::startsWith($commerce->dsc_facebook, ['http://', 'https://'])
                                            ? $commerce->dsc_facebook
                                            : 'https://facebook.com/' . ltrim($commerce->dsc_facebook, '/');
                                    @endphp
                                    <a href="{{ $facebookUrl }}" target="_blank" rel="noopener"
                                        class="d-block text-decoration-none">
                                        {{ $commerce->dsc_facebook }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        {{-- Instagram --}}
                        @if ($commerce->dsc_instagram)
                            <div class="info-item" data-aos="fade-up" data-aos-delay="550">
                                <div class="info-icon"><i class="bi bi-instagram"></i></div>
                                <div class="info-content">
                                    <strong>Instagram:</strong>
                                    @php
                                        $instagramHandle = ltrim($commerce->dsc_instagram, '@');
                                        $instagramUrl = Str::startsWith($instagramHandle, ['http://', 'https://'])
                                            ? $instagramHandle
                                            : 'https://instagram.com/' . $instagramHandle;
                                    @endphp
                                    <a href="{{ $instagramUrl }}" target="_blank" rel="noopener"
                                        class="d-block text-decoration-none">
                                        {{ '@' . $instagramHandle }}
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>

                <div class="col-md-5" data-aos="fade-up" data-aos-delay="600">
                    @if ($commerce->dsc_latitud && $commerce->dsc_longitud)
                        <div class="map-container">
                            <iframe width="100%" height="350" frameborder="0" style="border:0; border-radius: 12px;"
                                src="https://www.openstreetmap.org/export/embed.html?bbox={{ $commerce->dsc_longitud - 0.002 }},{{ $commerce->dsc_latitud - 0.001 }},{{ $commerce->dsc_longitud + 0.002 }},{{ $commerce->dsc_latitud + 0.001 }}&layer=mapnik&marker={{ $commerce->dsc_latitud }},{{ $commerce->dsc_longitud }}"
                                allowfullscreen loading="lazy"></iframe>
                        </div>
                    @else
                        <p class="text-muted">Ubicación no disponible.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
