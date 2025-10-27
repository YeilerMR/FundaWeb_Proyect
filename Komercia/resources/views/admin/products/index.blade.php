@extends('admin.layouts.master')

@section('title', 'Productos del Comercio | Komercia')

@section('menu_commerce', 'active')

@push('styles')
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/admin/table.css') }}">
@endpush

@section('content')
    <div class="container-fluid py-3 py-md-4">
        <div class="card-surface">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.commerce.index') }}">Comercios</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.commerce.edit', $commerce->id_comercio) }}">
                            Comercio {{ $commerce->dsc_nombre }}
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Productos</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h4 fw-bold m-0">
                    Productos de: {{ $commerce->dsc_nombre }}
                </h1>

                {{-- Nuevo producto --}}
                <a href="{{ route('admin.commerce.products.create', $commerce->id_comercio) }}"
                    class="btn btn-primary-custom">
                    <i class="bi bi-plus-lg me-1"></i>
                    Nuevo Producto
                </a>
            </div>

            <!-- TABLE -->
            <div class="responsive-table">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Imagen</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td data-label="Nombre">{{ $product->dsc_nombre }}</td>
                                <td data-label="Precio">
                                    ₡{{ number_format($product->precio, 2) }}
                                </td>
                                <td data-label="Imagen">
                                    @if ($product->dsc_imagen_destacada)
                                        <img src="{{ asset($product->dsc_imagen_destacada) }}" class="table-img-thumb"
                                            alt="{{ $product->dsc_nombre }}">
                                    @else
                                        <span class="text-muted">Sin imagen</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="table-actions">
                                        <a href="{{ route('admin.product.edit', $product->id_producto) }}"
                                            class="btn-action edit" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <a href="{{ route('admin.product.gallery', $product->id_producto) }}"
                                            class="btn-action gallery" title="Galería de imágenes">
                                            <i class="bi bi-images"></i>
                                        </a>

                                        <form action="{{ route('admin.product.destroy', $product->id_producto) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-action delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('TemplateKomercia/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/libs/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/js/admin/modules/tableModule.js') }}"></script>
    <script src="{{ asset('TemplateKomercia/assets/js/admin/modules/datatable.js') }}"></script>
@endpush
