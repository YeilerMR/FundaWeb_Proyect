@extends('landing.layouts.master')

@section('title', 'Inicio | Komercia')

@push('styles')
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/comercio_detalle.css') }}">
@endpush

@section('content')

    @include('landing.partials.search')
    @include('landing.partials.commerce', [
        'commerces' => $commerces,
        'totalCommerces' => $totalCommerces,
    ])

    @include('landing.partials.products', [
        'products' => $products,
        'totalProducts' => $totalProducts
    ])

@endsection
