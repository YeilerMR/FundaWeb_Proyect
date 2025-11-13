$(function () {

    /* ===============================
       PREVIEW IMAGEN DESTACADA
    ================================ */
    const $fileInput = $("#productImage");
    const $thumb = $("#productThumb");

    ImagePreviewModule.bind($fileInput, $thumb);
    
    // Validación general de formularios (si aplica en esta página)
    if ($(".needs-validation").length) {
        ValidationModule.init();
    }

});
