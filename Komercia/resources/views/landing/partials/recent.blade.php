<section class="comercios-section py-5" id="comercios">
    <div class="container">
        <div class="section-header mb-5" data-aos="fade-up">
            <div class="d-flex align-items-center gap-3">
                <div class="section-icon">
                    <i class="bi bi-shop"></i>
                </div>
                <div>
                    <h2 class="section-title mb-1">Comercios Recientes</h2>
                    <p class="section-subtitle mb-0">Descubre los negocios más nuevos de tu comunidad</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            @forelse ($shops as $shop)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{$loop->index * 100 + 100 }}">
                <div class="comercio-card">
                    <div class="comercio-image">
                        <img src="{{asset($shop->dsc_imagen_destacada ?? 'img/komercia-logo.svg')}}"
                            alt="{{$shop->dsc_nombre ?? 'Comercio'}}">
                    </div>
                    <div class="comercio-body">
                        <div class="comercio-category">
                            <span>{{ $shop->categories->first()->dsc_nombre ?? 'Sin Categoria'}}</span>
                        </div>
                        <h3 class="comercio-title">{{$shop->dsc_nombre}}</h3>
                        <p class="comercio-description">{{ Str::limit($shop->dsc_descripcion, 100)}}</p>
                        <a href="#" class="btn btn-comercio w-100">
                            Ver Detalles
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-12 text-center">
                    <p>No Hay Comercios Registrados aun.</p>
                </div>
            @endforelse
            
        </div>
    </div>
</section>