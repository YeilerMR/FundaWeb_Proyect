<aside class="sidebar d-flex flex-column border-end">
    <button class="btn-close-sidebar d-lg-none" id="closeSidebar">
        <i class="bi bi-x-lg"></i>
    </button>

    <div class="px-3 py-4 d-flex align-items-center gap-2 sidebar-brand border-bottom">
        <div class="brand-icon"><i class="bi bi-shop"></i></div>
        <div class="brand-text">
            <div class="fw-bold">Komercia</div>
            <small class="text-secondary">Panel Admin</small>
        </div>
    </div>

    <nav class="px-3 mt-2 d-flex flex-column gap-1 sidebar-links">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link @yield('menu_dashboard')">
            <i class="bi bi-speedometer2"></i><span>Dashboard</span>
        </a>
        <a href="#" class="sidebar-link @yield('menu_comercios')">
            <i class="bi bi-shop"></i><span>Comercios</span>
        </a>
        <a href="{{ route('admin.category.index') }}" class="sidebar-link @yield('menu_categorias')">
            <i class="bi bi-tag"></i><span>Categorías</span>
        </a>
        <a href="{{ route('admin.slider.index') }}" class="sidebar-link @yield('menu_slider')">
            <i class="bi bi-images"></i><span>Slider</span>
        </a>
    </nav>

    <div class="flex-grow-1"></div>

    <div class="px-3 py-3">
        <button type="button" class="btn-logout w-100 d-flex align-items-center justify-content-center gap-2">
            <i class="bi bi-box-arrow-right"></i> <span>Cerrar sesión</span>
        </button>
    </div>
</aside>
