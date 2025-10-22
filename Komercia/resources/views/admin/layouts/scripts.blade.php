<!-- Bootstrap -->
<script src="{{ asset('TemplateKomercia/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jQuery -->
<script src="{{ asset('TemplateKomercia/assets/libs/jquery/jquery-3.6.4.min.js') }}"></script>

<!-- AOS -->
<script src="{{ asset('TemplateKomercia/assets/libs/aos/aos.js') }}"></script>
<script>
    AOS.init();
</script>

<!-- Core JS -->
<script src="{{ asset('TemplateKomercia/assets/js/admin/core/init.js') }}"></script>

{{-- Scripts adicionales por página --}}
@stack('scripts')
