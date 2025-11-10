<section class="search-section py-5" data-aos="fade-up">
    <div class="container">
        <form action="{{ route('landing.search') }}" method="get">
            <div class="search-wrapper">
                <i class="bi bi-search search-icon-left"></i>
                <input type="text" name="q" id="site-search-input" class="form-control search-input"
                    placeholder="Buscar comercios, productos o servicios..." autocomplete="off" value="{{ $q ?? '' }}">
                <button class="btn btn-search" type="submit" id="site-search-button">
                    <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </form>
    </div>
</section>