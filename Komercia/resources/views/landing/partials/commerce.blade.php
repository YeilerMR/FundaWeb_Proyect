<section class="category-section py-5">
    <div class="container">
        <div class="category-header mb-5" data-aos="fade-up">
            <h1 class="category-title">
                Todos los Comercios
            </h1>
            <p class="category-description">
                Descubre comercios cerca de ti
            </p>
        </div>

        <div class="row g-4">

            <div class="col-12">
                <div class="results-header mb-4" data-aos="fade-up" data-aos-delay="150">
                    <h4 class="results-title">
                        {{ $commerces->count() }} Comercio{{ $commerces->count() != 1 ? 's' : '' }}
                        Encontrado{{ $commerces->count() != 1 ? 's' : '' }}
                    </h4>
                </div>

                @if ($commerces->isEmpty())
                    <div class="col-12 text-center py-5">
                        <p>No se encontraron comercios en esta categoría.</p>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach ($commerces as $commerce)
                            <div class="col-md-6 col-lg-4" data-aos="fade-up"
                                data-aos-delay="{{ $loop->index * 50 + 200 }}">
                                <div class="comercio-card">
                                    <div class="comercio-image">
                                        <img src="{{ asset($commerce->dsc_imagen_destacada ?? 'images/default-shop.jpg') }}"
                                            alt="{{ $commerce->dsc_nombre }}" class="img-fluid">
                                    </div>
                                    <div class="comercio-body">
                                        <div class="comercio-category">
                                            <i class="bi bi-shop"></i>
                                            <span>{{ $commerce->categories->first()?->dsc_nombre ?? 'General' }}</span>
                                        </div>
                                        <h3 class="comercio-title">{{ $commerce->dsc_nombre }}</h3>
                                        <p class="comercio-description">{{ Str::limit($commerce->dsc_descripcion, 80) }}
                                        </p>
                                        <a href="#" class="btn btn-comercio w-100">
                                            Ver Detalles <i class="bi bi-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>
</section>
