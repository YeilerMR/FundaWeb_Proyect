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
                
            @empty
                <div class="col-12 text-center">
                    <p>No Hay Comercios Registrados aun.</p>
                </div>
            @endforelse
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{$loop->index * 100 + 100 }}">
                <div class="comercio-card">
                    <div class="comercio-image">
                        <img src="{{asset($shop->dsc_imagen_destacada ?? 'img/komercia-logo.svg')}}"
                            alt="{{$shop->dsc_nombre ?? 'Comercio'}}">
                    </div>
                    <div class="comercio-body">
                        <div class="comercio-category">
                            <span>Restaurante</span>
                        </div>
                        <h3 class="comercio-title">Restaurante Crickesio</h3>
                        <p class="comercio-description">Cocina gourmet con ingredientes locales y ambiente
                            acogedor</p>
                        <a href="#" class="btn btn-comercio w-100">
                            Ver Detalles
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="comercio-card">
                    <div class="comercio-image">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800"
                            alt="Hotel El Cricko">
                    </div>
                    <div class="comercio-body">
                        <div class="comercio-category">
                            <span>Hotel</span>
                        </div>
                        <h3 class="comercio-title">Hotel El Cricko</h3>
                        <p class="comercio-description">Hospedaje de lujo con todas las comodidades para tu
                            estadía</p>
                        <a href="#" class="btn btn-comercio w-100">
                            Ver Detalles
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="comercio-card">
                    <div class="comercio-image">
                        <img src="https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=800"
                            alt="Zapatería La Martha">
                    </div>
                    <div class="comercio-body">
                        <div class="comercio-category">
                            <span>Zapatería</span>
                        </div>
                        <h3 class="comercio-title">Zapatería La Martha</h3>
                        <p class="comercio-description">Calzado de calidad para toda la familia a precios
                            accesibles</p>
                        <a href="#" class="btn btn-comercio w-100">
                            Ver Detalles
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>