@php
    $slides = $sliders->map(function ($s) {
        return [
            'imagen' => asset($s->dsc_imagen),
            'titulo' => $s->dsc_titulo,
            'subtitulo' => $s->dsc_descripcion,
            'enlace' => $s->dsc_enlace,
        ];
    });
@endphp

<section class="hero-section text-white d-flex align-items-center justify-content-center text-center">

    <!-- Slick container -->
    <div class="hero-slick" id="heroSlickData" data-slides='@json($slides)'>
        @foreach ($sliders as $slider)
            <div class="hero-slide"></div>
        @endforeach
    </div>

    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h2 class="hero-title"></h2>
        <p class="hero-subtitle"></p>
        <a href="#" class="btn-hero btn-slider">Ver más</a>
    </div>

    <button class="hero-arrow left"><i class="bi bi-arrow-left"></i></button>
    <button class="hero-arrow right"><i class="bi bi-arrow-right"></i></button>

    @include('landing.partials.hero-waves')

</section>
