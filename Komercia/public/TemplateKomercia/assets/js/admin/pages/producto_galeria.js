$(function () {

    const $grid = $("#galleryGrid");
    const $empty = $("#galleryEmpty");
    const $form = $("#formGalleryProduct");
    const $input = $("#productGalleryInput");

    window.galleryPendingDelete = [];

    function togglePlaceholder() {
        if ($grid.children().length === 0) $empty.show();
        else $empty.hide();
    }

    $input.on("change", function (e) {
        const files = e.target.files;
        if (!files || !files.length) return;

        for (const file of files) {
            if (!ImageValidator.validateFile(file)) {
                $input.val("");
                return;
            }
        }
    });

    // INIT DROPZONE MODULE
    GalleryModule.bind(
        $("#productGalleryDrop"),
        $grid,
        $input,
        $("#btnPickProductGallery"),
        togglePlaceholder
    );

    // MARCAR PARA ELIMINAR
    $(document).on("click", ".thumb-remove", function (e) {
        e.preventDefault();
        e.stopPropagation();

        const $item = $(this).closest(".thumb-item");
        const imageId = $item.data("image-id");
        const imageSrc = $item.find("img").attr("src");

        if (imageId) {
            galleryPendingDelete.push({ id: imageId, src: imageSrc });
            $form.append(`<input type="hidden" name="delete_images[]" value="${imageId}">`);
        }

        $item.remove();
        togglePlaceholder();
    });

    // CONFIRMAR ENVÍO
    $form.on("submit", function (e) {
        e.preventDefault();

        const newImagesCount = $input[0].files.length;
        const deletedCount = galleryPendingDelete.length;
        let previewHTML = "";

        if (deletedCount > 0) {
            previewHTML += `<div style="margin-bottom:10px;">
                <strong>Imágenes a eliminar (${deletedCount}):</strong><br>
                <div style="display:flex; flex-wrap:wrap; gap:8px; margin-top:6px;">`;

            galleryPendingDelete.forEach(img => {
                previewHTML += `<img src="${img.src}" style="width:60px;height:60px;object-fit:cover;border-radius:6px;border:1px solid #ddd;">`;
            });

            previewHTML += `</div></div>`;
        }

        if (newImagesCount > 0) {
            previewHTML += `<div style="margin-top:10px;">
                <strong>Imágenes nuevas a subir: ${newImagesCount}</strong>
            </div>`;
        }

        Swal.fire({
            title: 'Confirmar cambios',
            html: previewHTML || 'No se han detectado cambios, ¿deseas continuar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Guardar cambios',
            cancelButtonText: 'Cancelar',
            reverseButtons: true,
            width: 500
        }).then((result) => {
            if (result.isConfirmed) {
                $form.off('submit');
                $form.submit();
            }
        });
    });

    togglePlaceholder();
});