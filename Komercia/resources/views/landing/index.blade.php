@extends('landing.layouts.master')

@section('title', 'Inicio | Komercia')

@section('content')
    @include('landing.partials.hero', ['sliders' => $sliders])

    {{-- luego más secciones aquí --}}
    @include('landing.partials.search')
    @include('landing.partials.recent', ['shops' => $shops])
    @include('landing.partials.category-explore', ['categories' => $categories])
    
@endsection
