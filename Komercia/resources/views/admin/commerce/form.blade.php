@extends('admin.layouts.master')

@section('title', isset($commerce) ? 'Editar Comercio | Komercia' : 'Nuevo Comercio | Komercia')
@section('menu_commerce', 'active')

@push('styles')
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/admin/form_style.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')
    <div class="container-fluid py-3 py-md-4">

        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('admin.commerce.index') }}" class="btn btn-light btn-back rounded-pill px-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="h4 m-0 fw-bold" id="formTitle">
                {{ isset($commerce) ? 'Editar Comercio' : 'Nuevo Comercio' }}
            </h1>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.commerce.index') }}">Comercios</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ isset($commerce) ? 'Editar Comercio' : 'Nuevo Comercio' }}
                </li>
            </ol>
        </nav>

        {{-- <!-- BOTONES  (solo modo editar) -->
        <div id="extraActions" class="{{ isset($commerce) ? '' : 'd-none' }}">
            <a id="btnGestionGaleria" href="#" class="btn btn-outline-secondary">
                <i class="bi bi-images me-1"></i> Gestionar Galería
            </a>
            <a id="btnGestionProductos" href="#" class="btn btn-outline-secondary ms-1">
                <i class="bi bi-basket2 me-1"></i> Gestionar Productos
            </a>
        </div> --}}

        <!-- FORM -->
        <form id="comercioForm" class="needs-validation"
            action="{{ isset($commerce) ? route('admin.commerce.update', $commerce->id_comercio) : route('admin.commerce.store') }}"
            method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @if (isset($commerce))
                @method('PUT')
            @endif

            <!-- INFORMACIÓN BÁSICA -->
            <section class="card-surface p-3 p-md-4 mb-3">
                <h6 class="section-heading"><i class="bi bi-info-circle me-2"></i>Información Básica</h6>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="nombre" class="form-label">Nombre *</label>
                            <input type="text" class="form-control" id="nombre" name="dsc_nombre"
                                value="{{ old('dsc_nombre', $commerce->dsc_nombre ?? '') }}" required>
                            <div class="invalid-feedback">El nombre es obligatorio.</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Descripción *</label>
                            <textarea class="form-control" id="dsc_descripcion" name="dsc_descripcion" rows="3" required>{{ old('dsc_descripcion', $commerce->dsc_descripcion ?? '') }}</textarea>
                            <div class="invalid-feedback">La descripción es obligatoria.</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label class="form-label">Imagen Destacada {{ isset($commerce) ? '' : '*' }}</label>

                            <div class="img-thumb" id="commerceThumb">
                                @if (isset($commerce) && $commerce->dsc_imagen_destacada)
                                    <img src="{{ asset($commerce->dsc_imagen_destacada) }}">
                                @else
                                    <i class="bi bi-image"></i>
                                @endif
                            </div>

                            <input class="form-control mt-2" type="file" id="commerceImage" name="dsc_imagen_destacada"
                                accept="image/*" {{ isset($commerce) ? '' : 'required' }}>

                            <small class="text-secondary">PNG/JPG, máx.5MB — Ideal: 1920×600</small>
                            <div class="invalid-feedback">La imagen destacada es obligatoria.</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CATEGORÍAS -->
            <section class="card-surface p-3 p-md-4 mb-3" id="categoriesSection">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <h6 class="section-heading mb-0"><i class="bi bi-tags me-2"></i>Categorías</h6>
                    <div class="d-flex gap-2">
                        <button type="button" id="btnOpenCategories" class="btn btn-primary-custom">
                            <i class="bi bi-plus-lg me-1"></i>Seleccionar categorías
                        </button>
                        <button type="button" id="btnClearCategories" class="btn btn-light">
                            <i class="bi bi-eraser me-1"></i>Limpiar
                        </button>
                    </div>
                </div>

                <div id="selectedCategories" class="chips-container mt-3" aria-live="polite"></div>
                <div id="categoriesHidden" class="d-none"></div>

                <div class="invalid-feedback d-block" id="categoriesFeedback" style="display:none;">
                    Debes seleccionar al menos una categoría.
                </div>
            </section>

            <!-- CONTACTO -->
            <section class="card-surface p-3 p-md-4 mb-3">
                <h6 class="section-heading"><i class="bi bi-person-lines-fill me-2"></i>Contacto</h6>
                <div class="row g-3">
                    <div class="col-12 col-lg-6" id="phonesSection">
                        <label class="form-label">Teléfonos (máx. 5)</label>
                        <div id="phonesTags" class="tag-input" data-name="telefonos[]" data-type="phone" data-max="5"
                            aria-label="Teléfonos"></div>
                        <small class="text-secondary">Presiona Enter para añadir. Ej: +506 8888 8888</small>
                        <div class="invalid-feedback d-block" id="phonesFeedback" style="display:none;">
                            Debes registrar al menos un teléfono.
                        </div>
                    </div>

                    <div class="col-12 col-lg-6" id="emailsSection">
                        <label class="form-label">Emails (máx. 5)</label>
                        <div id="emailsTags" class="tag-input" data-name="emails[]" data-type="email" data-max="5"
                            aria-label="Emails"></div>
                        <small class="text-secondary">Presiona Enter para añadir. Ej: contacto@comercio.com</small>
                        <div class="invalid-feedback d-block" id="emailsFeedback" style="display:none;">
                            Debes registrar al menos un correo.
                        </div>
                    </div>
                </div>
            </section>

            <!-- REDES SOCIALES -->
            <section class="card-surface p-3 p-md-4 mb-3">
                <h6 class="section-heading"><i class="bi bi-share me-2"></i>Redes Sociales</h6>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Instagram</label>
                        <input type="text" name="dsc_instagram" class="form-control"
                            value="{{ old('dsc_instagram', $commerce->dsc_instagram ?? '') }}" placeholder="@comercio"
                            required>
                        <div class="invalid-feedback">El Instagram es obligatorio.</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Facebook</label>
                        <input type="text" name="dsc_facebook" class="form-control"
                            value="{{ old('dsc_facebook', $commerce->dsc_facebook ?? '') }}"
                            placeholder="facebook.com/comercio" required>
                        <div class="invalid-feedback">El Facebook es obligatorio.</div>
                    </div>
                </div>
            </section>

            <!-- UBICACIÓN -->
            <section class="card-surface p-3 p-md-4 mb-3">
                <h6 class="section-heading"><i class="bi bi-geo-alt me-2"></i>Ubicación</h6>
                <div class="row g-3">
                    <div class="col-12 col-lg-8">
                        <div id="map" class="mapbox"></div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="d-grid gap-2">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="dsc_direccion" id="addressInput" class="form-control"
                                value="{{ old('dsc_direccion', $commerce->dsc_direccion ?? '') }}" required>
                            <div class="invalid-feedback">La dirección es obligatoria.</div>

                            <label class="form-label mt-2">Buscar dirección</label>
                            <div class="input-group">
                                <input type="text" id="geocodeQuery" class="form-control"
                                    placeholder="Ej: Parque Central, San José">
                                <button type="button" id="btnGeocode" class="btn btn-outline-primary"><i
                                        class="bi bi-search"></i></button>
                            </div>

                            <button type="button" class="btn btn-primary-custom" id="btnMyLocation">
                                <i class="bi bi-geo-fill me-1"></i> Usar mi ubicación
                            </button>

                            <div class="row g-2">
                                <div class="col-6">
                                    <label class="form-label mt-2">Latitud</label>
                                    <input type="text" class="form-control" name="dsc_latitud" id="latInput"
                                        value="{{ old('dsc_latitud', $commerce->dsc_latitud ?? '') }}" required>
                                    <div class="invalid-feedback">La latitud es obligatoria.</div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label mt-2">Longitud</label>
                                    <input type="text" class="form-control" name="dsc_longitud" id="lngInput"
                                        value="{{ old('dsc_longitud', $commerce->dsc_longitud ?? '') }}" required>
                                    <div class="invalid-feedback">La longitud es obligatoria.</div>
                                </div>
                            </div>
                            <small class="text-secondary">Arrastra el marcador para ajustar con
                                precisión.</small>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ACCIONES -->
            <div class="d-flex align-items-center justify-content-end gap-2">
                <a href="{{route('admin.commerce.index')}}" class="btn btn-light">Cancelar</a>
                <button type="submit" class="btn btn-primary-custom">Guardar Comercio</button>
            </div>

        </form>
    </div>

    <!-- Modal Categorías -->
    <div class="modal fade" id="categoriesModal" tabindex="-1" aria-labelledby="categoriesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoriesModalLabel"><i class="bi bi-tags me-2"></i>Seleccionar
                        categorías</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" id="categoriesSearch" class="form-control"
                                placeholder="Buscar categoría...">
                        </div>
                    </div>
                    <div id="categoriesList" class="categories-list"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSaveCategories" class="btn btn-primary-custom">Guardar
                        selección</button>
                </div>
            </div>
        </div>
    </div>

    @php
        $oldCategories = old('categories', isset($categoriesIds) ? $categoriesIds : []);
        $oldPhones = old('telefonos', isset($phones) ? $phones : []);
        $oldEmails = old('emails', isset($emails) ? $emails : []);
    @endphp

    @if (isset($categories))
        <script>
            window.__CATEGORIES_DATA__ = @json($categories);
        </script>
    @endif

    @if (isset($commerce))
        <script>
            window.__COMMERCE_DATA__ = {
                id: @json($commerce->id_comercio),
                categories: @json($categoriesIds ?? []),
                phones: @json($phones ?? []),
                emails: @json($emails ?? [])
            };
        </script>
    @endif

@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="{{ asset('TemplateKomercia/assets/js/admin/modules/categoriesModal.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/js/admin/modules/tags.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/js/admin/modules/map.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/js/admin/modules/validation.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/js/admin/modules/imagePreview.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/js/admin/pages/comercio_form.js') }}"></script>
@endpush
