@extends('landing.layouts.master')

@section('title', 'Comercios | Komercia')

@push('styles')
    <link rel="stylesheet" href="{{ asset('TemplateKomercia/assets/css/comercio_detalle.css')}}">
@endpush

@section('content')
    @include('landing.partials.search')
    @include('landing.partials.by-categories', 
        [
            'categories'=>$categories, 
            'commerces'=> $commerces, 
            'selectedCategory'=> $selectedCategory,
            'totalCommerces'=>$totalCommerces
        ]
    )
@endsection