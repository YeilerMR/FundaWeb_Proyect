// Módulo: Galería
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

        $item.find(".thumb-remove").on("click", function () {
            $item.remove();
            if (typeof onChange === "function") onChange();
        });

        $container.append($item);
        if (typeof onChange === "function") onChange();
    }

    async function handleFiles(files, $container, $input, onChange) {

        const dt = new DataTransfer();

        for (const oldFile of $input[0].files) {
            dt.items.add(oldFile);
        }

        for (const file of files) {

            const converted = await ImageValidator.validateAndConvert(file);

            if (!converted) continue;

            addThumb(converted, $container, onChange);

            dt.items.add(converted);
        }

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

        $input.off("change.gallery").on("change.gallery", async e => {
            await handleFiles(e.target.files, $grid, $input, onChange);
            $input.val("");
        });
    }

    return { bind };

})();
