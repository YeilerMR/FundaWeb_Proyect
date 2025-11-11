$(function () {
    // Validación
    ValidationModule.init();

    // Preview imagen categoría
    ImagePreviewModule.bind($("#categoryImage"), $("#categoryThumb"));
});
