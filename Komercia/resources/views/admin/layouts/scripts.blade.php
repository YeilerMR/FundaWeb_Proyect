<!-- Bootstrap -->
<script src="{{ asset('TemplateKomercia/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- jQuery -->
<script src="{{ asset('TemplateKomercia/assets/libs/jquery/jquery-3.6.4.min.js') }}"></script>

<!-- AOS -->
<script src="{{ asset('TemplateKomercia/assets/libs/aos/aos.js') }}"></script>
<script>
    AOS.init();
</script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Core JS -->
<script src="{{ asset('TemplateKomercia/assets/js/admin/core/init.js') }}"></script>

<!-- UI Feedback (Toasts + Confirms) -->
<script src="{{ asset('TemplateKomercia/assets/js/admin/core/ui.js') }}"></script>

{{-- toast from session --}}
@if (session('success'))
    <script>
        $(function() {
            UI.showToast('success', "{{ session('success') }}");
        });
    </script>
@endif

@if (session('error'))
    <script>
        $(function() {
            UI.showToast('error', "{{ session('error') }}");
        });
    </script>
@endif

{{-- Scripts adicionales por página --}}
@stack('scripts')
