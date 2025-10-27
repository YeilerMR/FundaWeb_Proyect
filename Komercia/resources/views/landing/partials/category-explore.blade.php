<section class="categorias-section py-5">
    <div class="container">
        <div class="section-header mb-5" data-aos="fade-up">
            <div class="d-flex align-items-center gap-3">
                <div class="section-icon">
                    <i class="bi bi-grid-3x3-gap"></i>
                </div>
                <div>
                    <h2 class="section-title mb-1">Explora por Categoría</h2>
                    <p class="section-subtitle mb-0">Encuentra exactamente lo que buscas</p>
                </div>
            </div>
        </div>

        <div class="row g-4 justify-content-between align-items-center">

            @forelse ($categories as $index => $category)
                
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{($index * 50) + 100}}">
                    <a href="#" class="category-card">
                        <div class="category-image">
                            <img src="{{asset($category->dsc_imagen ?? 'img/komercia-logo.svg')}}"
                                alt="{{ $category->dsc_nombre }}">
                        </div>
                        <h4 class="category-title">{{ $category->dsc_nombre }}</h4>
                        <p class="category-count">
                            {{  $category->commerces_count > 0 ? $category->commerces_count . '+ negocios' : 'Sin Negocios'}}
                        </p>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No hay categorías disponibles.</p>
                </div>
            @endforelse

        </div>
    </div>
</section>