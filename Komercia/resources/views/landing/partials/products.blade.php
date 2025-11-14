<section class="category-section py-5">
    <div class="container">
        <div class="category-header mb-5" data-aos="fade-up">
            <h1 class="category-title">
                Todos los Productos
            </h1>
            <p class="category-description">
                Descubre productos cerca de ti
            </p>
        </div>

        <div class="row g-4" style="
    padding-left: 10px;">

            <div class="col-lg-9 px-0" style="width: 100%;">
                <div class="results-header mb-4" data-aos="fade-up" data-aos-delay="150">
                    <h4 class="results-title">
                        {{ $products->count() }} Producto{{ $products->count() != 1 ? 's' : '' }}
                        Encontrado{{ $products->count() != 1 ? 's' : '' }}
                    </h4>
                </div>

                @if ($products->isNotEmpty())
                    <div class="row g-4 mx-0">
                        @foreach ($products as $product)
                            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up"
                                data-aos-delay="{{ $loop->index * 50 + 300 }}">
                                <div class="product-card">
                                    <div class="product-image">
                                        <img src="{{ asset($product->dsc_imagen_destacada ?? 'images/default-product.jpg') }}"
                                            alt="{{ $product->dsc_nombre }}" class="img-fluid">
                                    </div>
                                    <div class="product-body">
                                        <h6 class="product-title">{{ $product->dsc_nombre }}</h6>
                                        <p class="product-price">${{ number_format($product->precio, 2) }}</p>
                                        <a href="#" class="btn btn-product">Ver más</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No se encontraron productos.</p>
                @endif
            </div>
        </div>
    </div>
</section>
