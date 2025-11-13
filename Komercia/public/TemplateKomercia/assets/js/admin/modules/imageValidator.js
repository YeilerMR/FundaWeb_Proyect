async function compressToWebP(file, quality = 0.8, maxWidth = 1280) {
    return new Promise((resolve, reject) => {
        const img = new Image();
        const reader = new FileReader();

        reader.onload = (e) => {
            img.src = e.target.result;
        };

        img.onload = () => {
            const canvas = document.createElement("canvas");
            let width = img.width;
            let height = img.height;

            if (width > maxWidth) {
                height = (maxWidth * height) / width;
                width = maxWidth;
            }

            canvas.width = width;
            canvas.height = height;

            const ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, width, height);

            canvas.toBlob(
                (blob) => {
                    if (!blob) {
                        reject("No se pudo generar WebP");
                        return;
                    }

                    const webpFile = new File([blob], file.name.replace(/\.\w+$/, ".webp"), {
                        type: "image/webp",
                        lastModified: Date.now()
                    });

                    resolve(webpFile);
                },
                "image/webp",
                quality
            );
        };

        reader.onerror = (err) => reject(err);
        reader.readAsDataURL(file);
    });
}

const ImageValidator = (() => {
    const allowedTypes = ["image/jpeg", "image/png", "image/jpg", "image/webp"];
    const maxSizeMB = 1;

    async function validateAndConvert(file) {
        if (!file) return false;

        if ($.inArray(file.type, allowedTypes) === -1) {
            Swal.fire({
                icon: "error",
                title: "Formato no permitido",
                text: "Solo se permiten imágenes en formato PNG, JPG o WebP.",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Entendido"
            });
            return false;
        }

        const sizeMB = file.size / (1024 * 1024);
        if (sizeMB > maxSizeMB) {
            try {
                const compressed = await compressToWebP(file);

                const newSizeMB = compressed.size / (1024 * 1024);

                if (newSizeMB <= maxSizeMB) {
                    return compressed;
                }

                Swal.fire({
                    icon: "warning",
                    title: "Archivo demasiado grande",
                    text: `Incluso tras la compresión, la imagen pesa ${newSizeMB.toFixed(
                        2
                    )} MB. El máximo permitido es ${maxSizeMB} MB.`,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Entendido"
                });

                return false;
            } catch (e) {
                Swal.fire({
                    icon: "error",
                    title: "Error al comprimir la imagen",
                    text: "No fue posible reducir la imagen. Intenta con otra.",
                    confirmButtonColor: "#3085d6",
                });
                return false;
            }
        }

        const optimized = await compressToWebP(file);
        return optimized;
    }

    return { validateAndConvert };
})();