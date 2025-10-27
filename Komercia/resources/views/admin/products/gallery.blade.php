@extends('admin.layouts.master')

@section('title', 'Galería del Producto | Komercia')
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
            <h1 class="h4 m-0 fw-bold">Galería del Producto: {{ $product->dsc_nombre }}</h1>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.commerce.index') }}">Comercios</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.commerce.edit', $commerce->id_comercio) }}">
                        {{ $commerce->dsc_nombre }}
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.commerce.products.index', $commerce->id_comercio) }}">
                        Productos
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Galería</li>
            </ol>
        </nav>

        <!-- GALERÍA -->
        <section class="card-surface p-3 p-md-4 mb-3">
            <h6 class="section-heading"><i class="bi bi-images me-2"></i>Imágenes del Producto</h6>

            <small class="text-secondary">
                Formatos permitidos: JPG/PNG · Tamaño recomendado: 2MB por imagen
            </small>

            <!-- FORM REAL -->
            <form id="formGalleryProduct" action="{{ route('admin.product.gallery.store', $product->id_producto) }}"
                method="POST" enctype="multipart/form-data" class="mt-3">
                @csrf

                <div id="productGalleryDrop" class="dropzone mt-3">
                    <div class="dz-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                    <p class="mb-2">Arrastra imágenes aquí o haz clic para seleccionar</p>
                    <button class="btn btn-light" type="button" id="btnPickProductGallery">Seleccionar Imágenes</button>
                    <input type="file" id="productGalleryInput" name="images[]" multiple accept="image/*" class="d-none">
                </div>

                <!-- LISTA DE IMÁGENES EXISTENTES -->
                <div id="galleryGrid" class="thumb-grid mt-3">
                    @foreach ($product->images as $image)
                        <div class="thumb-item" data-image-id="{{ $image->id_imagen }}">
                            <img src="{{ asset($image->dsc_url) }}" alt="{{ $image->dsc_alt ?? $product->dsc_nombre }}">
                            <button type="button" class="thumb-remove"><i class="bi bi-x-circle"></i></button>
                        </div>
                    @endforeach
                </div>

                <!-- PLACEHOLDER -->
                @if ($product->images->count() == 0)
                    <div id="galleryEmpty" class="text-center text-secondary mt-4">
                        <i class="bi bi-image fs-1 d-block mb-2"></i>
                        No hay imágenes en la galería todavía.
                    </div>
                @endif

                <!-- BOTONES -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.commerce.products.index', $commerce->id_comercio) }}"
                        class="btn btn-light">Cancelar</a>
                    <button type="submit" class="btn btn-primary-custom">Guardar cambios</button>
                </div>
            </form>
        </section>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('TemplateKomercia/assets/js/admin/modules/gallery.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/js/admin/pages/producto_galeria.js') }}"></script>
@endpush
