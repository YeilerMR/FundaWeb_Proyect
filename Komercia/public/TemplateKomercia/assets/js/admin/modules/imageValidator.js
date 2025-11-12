// Módulo: ImageValidator (usa jQuery + SweetAlert2)
const ImageValidator = (() => {

    const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];

    function validateFile(file) {
        if (!file) return false;

        if ($.inArray(file.type, allowedTypes) === -1) {
            Swal.fire({
                icon: "error",
                title: "Formato no permitido",
                text: "Solo se permiten imágenes en formato PNG o JPG.",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Entendido"
            });
            return false;
        }
        return true;
    }

    return { validateFile };

})();