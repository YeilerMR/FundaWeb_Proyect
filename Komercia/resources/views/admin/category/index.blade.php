@extends('admin.layouts.master')

@section('title', 'Gestión de Categorías | Komercia')

@section('menu_category', 'active')

@push('styles')
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/admin/table.css') }}">
@endpush

@section('content')
        <div class="container-fluid py-3 py-md-4">

            <div class="card-surface p-3 p-md-4">

                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Categorías</li>
                    </ol>
                </nav>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="h4 fw-bold m-0">Gestión de Categorías</h1>
                    <a href="{{ route('admin.category.create') }}" class="btn btn-primary-custom">
                        <i class="bi bi-plus-lg me-1"></i> Nueva Categoría
                    </a>
                </div>

                <div class="responsive-table">
                    <table class="table-custom" id="categoriasTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td data-label="#">{{ $item->id_categoria }}</td>
                                    <td data-label="Nombre">{{ $item->dsc_nombre }}</td>
                                    <td data-label="Imagen">
                                        @if ($item->dsc_imagen)
                                            <img src="{{ asset($item->dsc_imagen )}}" alt="{{ $item->dsc_nombre }}"
                                                class="table-img-thumb" alt="Slide">
                                        @else
                                            <p>No hay imagen</p>
                                        @endif

                                    </td>
                                    <td data-label="Acciones" class="text-end">
                                        <div class="table-actions">
                                            <form action="{{ route('admin.category.edit',$item) }} ">
                                            <button class="btn-action edit" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            </form>
                                            <form method="post" action="{{ route('admin.category.destroy',$item) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action delete" title="Eliminar">
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
