@extends('landing.layouts.master')

@section('title', $commerce->dsc_nombre . ' - Contacto | Komercia')

@push('styles')
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/comercio_detalle.css') }}">
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
                <li class="breadcrumb-item active" aria-current="page">Contacto</li>
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
                <a class="nav-link" href="{{ route('landing.commerce.gallery', $commerce->id_comercio) }}">Galería</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('landing.commerce.contact', $commerce->id_comercio) }}">Contacto</a>
            </li>
        </ul>

        <!-- CONTACTO -->
        <div class="contact-section">
            @if(session('success'))
                <div class="alert alert-success" data-aos="fade-up">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" data-aos="fade-up">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h5 class="fw-bold mb-3" data-aos="fade-up" data-aos-delay="250">Contáctanos</h5>
            <p data-aos="fade-up" data-aos-delay="300">
                Utilice el siguiente formulario para enviar un mensaje a <strong>{{ $commerce->dsc_nombre }}</strong> y con
                gusto le atenderemos.
            </p>

            <form class="contact-form needs-validation" novalidate 
                  action="{{ route('landing.commerce.contact.send', $commerce->id_comercio) }}" 
                  method="POST" data-aos="fade-up" data-aos-delay="350">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dsc_nombre" class="form-label">Nombre *</label>
                            <input type="text" class="form-control" id="dsc_nombre" name="dsc_nombre"
                                value="{{ old('dsc_nombre') }}" placeholder="Tu nombre completo" required>
                        </div>

                        <div class="form-group">
                            <label for="dsc_telefono" class="form-label">Teléfono *</label>
                            <input type="tel" class="form-control" id="dsc_telefono" name="dsc_telefono"
                                value="{{ old('dsc_telefono') }}" placeholder="8888-8888" required>
                        </div>

                        <div class="form-group">
                            <label for="dsc_correo" class="form-label">Correo Electrónico *</label>
                            <input type="email" class="form-control" id="dsc_correo" name="dsc_correo"
                                value="{{ old('dsc_correo') }}" placeholder="tu@email.com" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group h-100">
                            <label for="dsc_mensaje" class="form-label">Mensaje *</label>
                            <textarea class="form-control h-100" id="dsc_mensaje" name="dsc_mensaje" rows="8"
                                placeholder="Escribe tu mensaje aquí..." required>{{ old('dsc_mensaje') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-submit px-4">
                            Enviar Mensaje
                            <i class="bi bi-send ms-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
@endpush