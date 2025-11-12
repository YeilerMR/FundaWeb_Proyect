// Módulo: Galería (drag & drop + preview + sincronización con input)
const GalleryModule = (() => {

    function addThumb(file, $container, onChange) {
        const url = URL.createObjectURL(file);
        const $item = $(`
            <div class="thumb-item">
                <img src="${url}" alt="img">
                <button type="button" class="thumb-remove">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        `);

        $item.data("file", file);

        // Eliminar miniatura
        $item.find(".thumb-remove").on("click", function () {
            $item.remove();
            if (typeof onChange === "function") onChange();
        });

        $container.append($item);
        if (typeof onChange === "function") onChange();
    }

    function handleFiles(files, $container, $input, onChange) {
        const dt = new DataTransfer();

        // Mantener archivos anteriores
        for (const oldFile of $input[0].files) dt.items.add(oldFile);

        // Validar y agregar los nuevos archivos
        for (const file of files) {
            if (typeof ImageValidator !== "undefined" && !ImageValidator.validateFile(file)) continue;
            addThumb(file, $container, onChange);
            dt.items.add(file);
        }

        // Actualizar input
        $input[0].files = dt.files;
    }

    function bind($drop, $grid, $input, $btnPick, onChange) {

        ["dragenter", "dragover"].forEach(evt => {
            $drop.on(evt, e => {
                e.preventDefault();
                e.stopPropagation();
                $drop.addClass("is-dragover");
            });
        });

        ["dragleave", "drop"].forEach(evt => {
            $drop.on(evt, e => {
                e.preventDefault();
                e.stopPropagation();
                if (evt === "drop") {
                    const files = e.originalEvent.dataTransfer.files;
                    if (files.length) handleFiles(files, $grid, $input, onChange);
                }
                $drop.removeClass("is-dragover");
            });
        });

        $drop.on("click", e => {
            if ($(e.target).is("button, i, input")) return;
            $input.trigger("click");
        });

        $btnPick.on("click", () => $input.trigger("click"));

        // Mover aquí la validación (solo una vez)
        $input.off("change.gallery").on("change.gallery", e => {
            handleFiles(e.target.files, $grid, $input, onChange);
            // Reset para evitar duplicados al volver a seleccionar lo mismo
            $input.val("");
        });
    }

    return { bind };

})();
