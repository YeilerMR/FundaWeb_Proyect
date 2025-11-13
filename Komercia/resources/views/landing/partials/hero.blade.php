@php
    $slides = $sliders->map(function ($s) {
        $url = trim($s->dsc_enlace);

        if ($url) {
            // Caso 1: viene como "https:enlace.com"
            if (preg_match('#^https:([^/])#i', $url)) {
                $url = 'https://' . substr($url, 6);
            }
            // Caso 2: viene como "http:enlace.com"
            elseif (preg_match('#^http:([^/])#i', $url)) {
                $url = 'http://' . substr($url, 5);
            }
            // Caso 3: NO tiene protocolo (facebook.com)
            elseif (!preg_match('#^https?://#i', $url)) {
                $url = 'https://' . $url;
            }
        }

        return [
            'imagen' => asset($s->dsc_imagen),
            'titulo' => $s->dsc_titulo,
            'subtitulo' => $s->dsc_descripcion,
            'enlace' => $url,
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
