<section class="category-section py-5">
    <div class="container">
        <div class="category-header mb-5" data-aos="fade-up">
            <h1 class="category-title">
                Todos los Productos
            </h1>
            <p class="category-description">
                'Descubre productos cerca de ti
            </p>
        </div>

        <div class="row g-4">

            <!-- Main Commerce Grid -->
            <div class="col-lg-9">
                <div class="results-header mb-4" data-aos="fade-up" data-aos-delay="150">
                    <h4 class="results-title">
                        {{ $products->count() }} Producto{{ $products->count() != 1 ? 's' : '' }}
                        Encontrado{{ $products->count() != 1 ? 's' : '' }}
                    </h4>
                </div>

                @if (!$products->isEmpty())
                    <div class="row g-4">
                        @foreach ($products as $prod)
                            {{-- <h1>{{ $prod->dsc_nombre }}</h1> --}}
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
