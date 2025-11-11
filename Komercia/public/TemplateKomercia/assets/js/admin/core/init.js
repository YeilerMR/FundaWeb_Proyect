$(function () {
    const $sidebar = $(".sidebar");
    const $main = $(".main");
    const $overlay = $("#sidebarOverlay");

    // Detectar si es móvil
    const isMobile = () => window.innerWidth <= 575.98;

    // Toggle sidebar
    $("#sidebarToggle").on("click", function () {
        const isCollapsed = $sidebar.toggleClass("collapsed").hasClass("collapsed");
        $main.toggleClass("expanded");

        if (isMobile()) {
            $overlay.toggleClass("active", isCollapsed);
        }
    });

    // Cerrar en botón X o overlay
    $("#closeSidebar, #sidebarOverlay").on("click", function () {
        $sidebar.removeClass("collapsed");
        $main.removeClass("expanded");
        $overlay.removeClass("active");
    });

    // Obtener nombre del backend (inyectado desde Blade)
    const userName = $("meta[name='user-name']").attr("content") || "Usuario";

    // Generar iniciales
    const initials = $.trim(userName)
        .split(/\s+/)
        .map(n => n[0])
        .join("")
        .toUpperCase()
        .slice(0, 3);

    $("#userInitials").text(initials || "AD");
});
