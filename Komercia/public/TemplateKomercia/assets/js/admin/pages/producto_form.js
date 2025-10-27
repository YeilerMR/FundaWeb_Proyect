$(function () {

    /* ===============================
       PREVIEW IMAGEN DESTACADA
    ================================ */
    const $fileInput = $("#productImage");
    const $thumb = $("#productThumb");

    $fileInput.on("change", function (e) {
        const file = e.target.files?.[0];
        if (!file) return;

        const url = URL.createObjectURL(file);
        $thumb.html(`<img src="${url}" alt="preview">`);
    });
    
    // Validación general de formularios (si aplica en esta página)
    if ($(".needs-validation").length) {
        ValidationModule.init();
    }

});
