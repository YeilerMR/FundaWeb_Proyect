<!DOCTYPE html>
<html lang="es">

@include('admin.layouts.head')

<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="d-flex min-vh-100">
        @include('admin.partials.sidebar')

        <div class="main flex-grow-1 d-flex flex-column">
            @include('admin.partials.topbar')

            <main class="content-wrapper flex-grow-1">
                @yield('content')
            </main>

            @include('admin.partials.footer')
        </div>
    </div>

    @include('admin.layouts.scripts')

</body>

</html>
