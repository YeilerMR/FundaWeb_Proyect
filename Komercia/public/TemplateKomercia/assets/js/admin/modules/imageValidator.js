const ImageValidator = (() => {
    const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
    const maxSizeMB = 5;

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

        const sizeMB = file.size / (1024 * 1024);
        if (sizeMB > maxSizeMB) {
            Swal.fire({
                icon: "warning",
                title: "Archivo demasiado grande",
                text: `El tamaño máximo permitido es de ${maxSizeMB} MB. Tu archivo pesa ${sizeMB.toFixed(2)} MB.`,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Entendido"
            });
            return false;
        }

        return true;
    }

    return { validateFile };
})();
