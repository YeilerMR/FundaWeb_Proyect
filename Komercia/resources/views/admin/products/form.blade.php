@extends('admin.layouts.master')

@section('title', isset($product) ? 'Editar Producto | Komercia' : 'Nuevo Producto | Komercia')
@section('menu_commerce', 'active')

@push('styles')
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/admin/form_style.css') }}">
@endpush

@section('content')
    <div class="container-fluid py-3 py-md-4">

        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('admin.commerce.products.index', $commerce->id_comercio) }}"
                class="btn btn-light btn-back rounded-pill px-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="h4 m-0 fw-bold">
                @isset($product)
                    Editar Producto de {{ $commerce->dsc_nombre }}
                @else
                    Nuevo Producto de {{ $commerce->dsc_nombre }}
                @endisset
            </h1>
        </div>

        <!-- FORM -->
        <form id="productoForm" class="needs-validation"
            action="{{ isset($product)
                ? route('admin.product.update', $product->id_producto)
                : route('admin.commerce.products.store', $commerce->id_comercio) }}"
            method="POST" enctype="multipart/form-data" novalidate>

            @csrf
            @isset($product)
                @method('PUT')
            @endisset

            <input type="hidden" name="id_comercio" value="{{ $commerce->id_comercio }}">

            <!-- INFORMACIÓN BÁSICA -->
            <section class="card-surface p-3 p-md-4 mb-3">
                <h6 class="section-heading">
                    <i class="bi bi-info-circle me-2"></i> Información del Producto
                </h6>

                <div class="row g-3">
                    <div class="col-12 col-md-8">
                        <label class="form-label">Nombre *</label>
                        <input type="text" class="form-control" name="dsc_nombre" placeholder="Ej: Pizza Especial"
                            value="{{ old('dsc_nombre', $product->dsc_nombre ?? '') }}" required>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">Precio *</label>
                        <input type="number" step="0.01" min="0" class="form-control" name="precio"
                            placeholder="0.00" value="{{ old('precio', $product->precio ?? '') }}" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Descripción</label>
                        <textarea name="dsc_descripcion" rows="3" class="form-control" placeholder="Describe este producto..." required>{{ old('dsc_descripcion', $product->dsc_descripcion ?? '') }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Imagen Destacada *</label>
                        <div class="img-thumb" id="productThumb">
                            @if (isset($product) && $product->dsc_imagen_destacada)
                                <img src="{{ asset($product->dsc_imagen_destacada) }}" alt="imagen actual">
                            @else
                                <i class="bi bi-image"></i>
                            @endif
                        </div>
                        <input class="form-control mt-2" type="file" id="productImage" name="dsc_imagen_destacada"
                            accept="image/*" @if (!isset($product)) required @endif>
                        <small class="text-secondary">PNG/JPG/WEBP, máx.5MB — Ideal horizontal</small>
                    </div>
                </div>
            </section>

            <!-- BOTONES -->
            <div class="d-flex align-items-center justify-content-end gap-2">
                <a href="{{ route('admin.commerce.products.index', $commerce->id_comercio) }}"
                    class="btn btn-light">Cancelar</a>
                <button type="submit" class="btn btn-primary-custom">
                    {{ isset($product) ? 'Actualizar Producto' : 'Guardar Producto' }}
                </button>
            </div>

        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('TemplateKomercia/assets/js/admin/modules/validation.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/js/admin/modules/imagePreview.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/js/admin/pages/producto_form.js') }}"></script>
@endpush
