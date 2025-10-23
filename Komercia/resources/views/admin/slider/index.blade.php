@extends('admin.layouts.master')

@section('title', 'Gestión de Slider | Komercia')

@section('menu_slider', 'active')

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
                    <li class="breadcrumb-item active" aria-current="page">Slider</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h4 fw-bold m-0">Gestión de Slider</h1>
                <a href="{{ route('admin.slider.create') }}" class="btn btn-primary-custom">
                    <i class="bi bi-plus-lg me-1"></i> Nuevo Slide
                </a>
            </div>

            <div class="responsive-table">
                <table class="table-custom" id="sliderTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Subtítulo</th>
                            <th>Imagen</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $slider)
                            <tr>
                                <td data-label="#">{{ $slider->id_slider }}</td>
                                <td data-label="Título">{{ $slider->dsc_titulo }}</td>
                                <td data-label="Descripción">{{ $slider->dsc_descripcion }}</td>
                                <td data-label="Imagen">
                                    <img src="{{ asset($slider->dsc_imagen) }}" class="table-img-thumb"
                                        alt="{{ $slider->dsc_titulo }}">
                                </td>
                                <td data-label="Acciones" class="text-end">
                                    <div class="table-actions">
                                        <a href="{{ route('admin.slider.edit', $slider->id_slider) }}"
                                            class="btn-action edit" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.slider.destroy', $slider->id_slider) }}"
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
