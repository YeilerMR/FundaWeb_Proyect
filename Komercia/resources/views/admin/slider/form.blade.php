@extends('admin.layouts.master')

@section('title', isset($slider) ? 'Editar Slider | Komercia' : 'Nuevo Slider | Komercia')
@section('menu_slider', 'active')

@push('styles')
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/admin/form_style.css') }}">
@endpush

@section('content')
    <div class="container-fluid py-3 py-md-4">

        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('admin.slider.index') }}" class="btn btn-light btn-back rounded-pill px-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="h4 m-0 fw-bold">
                {{ isset($slider) ? 'Editar Slider' : 'Nuevo Slider' }}
            </h1>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}">Slider</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ isset($slider) ? 'Editar Slide' : 'Nuevo Slide' }}
                </li>
            </ol>
        </nav>

        <!-- FORM -->
        <form id="sliderForm" class="needs-validation" method="POST"
            action="{{ isset($slider) ? route('admin.slider.update', $slider->id_slider) : route('admin.slider.store') }}"
            enctype="multipart/form-data" novalidate>
            @csrf
            @if (isset($slider))
                @method('PUT')
            @endif

            <!-- DATOS DEL SLIDER -->
            <section class="card-surface p-3 p-md-4 mb-3">
                <h6 class="section-heading">
                    <i class="bi bi-images me-2"></i> Información del Slider
                </h6>

                <div class="row g-3">
                    <!-- TÍTULO -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dsc_titulo" class="form-label">Título *</label>
                            <input type="text" id="dsc_titulo" name="dsc_titulo" class="form-control"
                                value="{{ old('dsc_titulo', $slider->dsc_titulo ?? '') }}" required>
                            <div class="invalid-feedback">El título es obligatorio.</div>
                        </div>
                    </div>

                    <!-- SUBTÍTULO -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dsc_subtitulo" class="form-label">Subtítulo (máx. 50 caracteres)</label>
                            <input type="text" id="dsc_subtitulo" name="dsc_subtitulo" class="form-control"
                                maxlength="50" value="{{ old('dsc_subtitulo', $slider->dsc_descripcion ?? '') }}" required>
                            <div class="invalid-feedback">El subtítulo es obligatorio.</div>
                        </div>
                    </div>

                    <!-- ENLACE -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="dsc_enlace" class="form-label">Enlace</label>
                            <input type="url" id="dsc_enlace" name="dsc_enlace" class="form-control"
                                value="{{ old('dsc_enlace', $slider->dsc_enlace ?? '') }}" placeholder="https://ejemplo.com"
                                required>
                            <div class="invalid-feedback">El Enlace de interés es obligatorio.</div>
                        </div>
                    </div>

                    <!-- IMAGEN DEL SLIDER -->
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label class="form-label">Imagen {{ isset($slider) ? '' : '*' }}</label>

                            <div class="img-thumb" id="sliderThumb">
                                @if (isset($slider) && $slider->dsc_imagen)
                                    <img src="{{ asset($slider->dsc_imagen) }}"
                                        alt="{{ $slider->dsc_titulo ?? 'Imagen del slider' }}">
                                @else
                                    <i class="bi bi-image"></i>
                                @endif
                            </div>

                            <input class="form-control mt-2" type="file" id="sliderImage" name="dsc_imagen"
                                accept="image/*" {{ isset($slider) ? '' : 'required' }}>

                            <small class="text-secondary">PNG/JPG, máx. 2MB — Ideal: 1920×600</small>
                            <div class="invalid-feedback">Selecciona una imagen para el slider.</div>
                        </div>
                    </div>

                </div>
            </section>

            <!-- ACCIONES -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{route('admin.slider.index')}}" class="btn btn-light">Cancelar</a>
                <button type="submit" class="btn btn-primary-custom">
                    {{ isset($slider) ? 'Actualizar Slider' : 'Guardar Slider' }}
                </button>
            </div>

        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('TemplateKomercia/assets/js/admin/modules/validation.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/js/admin/modules/imagePreview.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/js/admin/pages/slider_form.js') }}"></script>
@endpush
