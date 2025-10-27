<header class="header fixed-top">
    <div class="container py-3">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('landing.home') }}">
                <div class="section-icon">
                    <i class="bi bi-shop"></i>
                </div>
                <span class="ms-2 fw-bold">Komercia</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-2">
                    <li class="nav-item">
                        <a href="{{ route('landing.home') }}" 
                        class="nav-link {{ request()->routeIs('landing.home') ? 'active' : ''}}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('landing.commerces')}}" 
                        class="nav-link {{ request()->routeIs('landing.commerces') ? 'active' : ''}}">Comercios</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="btn btn-primary-custom">Ingresar</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
