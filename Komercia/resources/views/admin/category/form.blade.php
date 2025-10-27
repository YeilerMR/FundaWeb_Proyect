@extends('admin.layouts.master')

@section('title', isset($category) ? 'Editar Categoría | Komercia' : 'Nuevo Categoría | Komercia')
@section('menu_category', 'active')

@push('styles')
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/admin/form_style.css') }}">
@endpush


@section('content')
    <div class="container-fluid py-3 py-md-4">

        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('admin.category.index') }}" class="btn btn-light btn-back rounded-pill px-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="h4 m-0 fw-bold">Nueva Categoría</h1>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/index.html">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Categorías</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nueva categoría</li>
            </ol>
        </nav>

        <!-- FORM -->
        <form id="categoriaForm" action="{{ isset($category) ? route('admin.category.update', $category) : route('admin.category.store') }}" class="needs-validation" method="POST"
            enctype="multipart/form-data" novalidate>
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif
            <!-- NOMBRE -->
            <section class="card-surface p-3 p-md-4 mb-3">
                <h6 class="section-heading"><i class="bi bi-tag me-2"></i>Nueva Categoría</h6>

                <div class="form-group mb-3">
                    <label for="dsc_nombre" class="form-label">Nombre *</label>
                    <input type="text" class="form-control" id="dsc_nombre" name="dsc_nombre"
                        placeholder="Ej: Restaurante, Hotel, Cafetería..."
                        value="{{ old('dsc_nombre', $category->dsc_nombre ?? '') }}" required>
                    <div class="invalid-feedback">
                        El nombre es obligatorio.
                    </div>
                </div>

                <!-- IMAGEN DESTACADA -->
                <div class="form-group">
                    <label class="form-label">Imagen Destacada *</label>
                    <div class="featured-upload">
                        <div class="featured-thumb" id="catThumb">
                            @if (isset($category) && $category->dsc_imagen)
                                <img src="{{ asset($category->dsc_imagen) }}" alt="{{ $category->dsc_nombre }}"
                                   class="bi bi-image">
                            @else
                                <i class="bi bi-image"></i>
                            @endif
                        </div>
                        <div class="featured-input">
                            <input class="form-control" type="file" id="catImage" name="dsc_imagen" accept="image/*"
                                required>
                            <small class="text-secondary">PNG/JPG, máx. 2MB</small>
                            <div class="invalid-feedback">
                                Selecciona una imagen para la categoría.
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ACCIONES -->
            <div class="d-flex justify-content-end gap-2">
                <button type="reset" class="btn btn-light">Cancelar</button>
                <button type="submit" class="btn btn-primary-custom">Guardar Categoría</button>
            </div>

        </form>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('TemplateKomercia/assets/js/admin/modules/validation.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/js/admin/modules/imagePreview.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/js/admin/pages/category_form.js') }}"></script>
@endpush
