@extends('admin.layouts.master')

@section('title', 'Gestión de Slider | Komercia')

@section('menu_commerce', 'active')

@push('styles')
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/admin/table.css') }}">
@endpush

@section('content')
    <div class="container-fluid py-3 py-md-4">
        <div class="card-surface p-3 p-md-4">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Comercios</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h4 fw-bold m-0">Gestión de Comercios</h1>
                <a href="{{ route('admin.commerce.create') }}" class="btn btn-primary-custom">
                    {{-- <a href="#" class="btn btn-primary-custom"> --}}
                    <i class="bi bi-plus-lg me-1"></i> Nuevo Comercio
                </a>
            </div>

            <div class="responsive-table">
                <table class="table-custom" id="comerciosTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Imagen</th>
                            <th>Categorías</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($commerces as $commerce)
                            <tr>
                                <td data-label="#">{{ $commerce->id_comercio }}</td>
                                <td data-label="Nombre">{{ $commerce->dsc_nombre }}</td>
                                <td data-label="Imagen">
                                    <img src="{{ asset($commerce->dsc_imagen_destacada) }}" class="table-img-thumb"
                                        alt="{{ $commerce->dsc_nombre }}">
                                </td>
                                <td data-label="Categorías">
                                    @php
                                        $categories = $commerce->categories->take(2);
                                        $remaining = $commerce->categories->count() - 2;
                                    @endphp

                                    @forelse ($categories as $category)
                                        <span class="comercio-category">{{ $category->dsc_nombre }}</span>
                                    @empty
                                        <span class="text-muted">-</span>
                                    @endforelse

                                    @if ($remaining > 0)
                                        <span class="comercio-category">+{{ $remaining }}</span>
                                    @endif
                                </td>
                                <td data-label="Acciones" class="text-end">
                                    <div class="table-actions">
                                        <a href="{{ route('admin.commerce.edit', $commerce->id_comercio) }}"
                                            class="btn-action edit" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="galeria.html" class="btn-action gallery" title="Galería">
                                            <i class="bi bi-images"></i>
                                        </a>
                                        <a href="/admin/productos/productos.html" class="btn-action products"
                                            title="Productos">
                                            <i class="bi bi-basket2"></i>
                                        </a>
                                        <form action="{{ route('admin.commerce.destroy', $commerce->id_comercio) }}"
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
