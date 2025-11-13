// Módulo: Image Preview (para inputs de una sola imagen)
const ImagePreviewModule = (() => {

    function bind($input, $thumb) {
        $input.on("change", async function (e) {
            let file = e.target.files?.[0];
            if (!file) return;

            const convertedFile = await ImageValidator.validateAndConvert(file);

            if (!convertedFile) {
                $input.val("");
                $thumb.html("");
                return;
            }

            const dt = new DataTransfer();
            dt.items.add(convertedFile);
            $input[0].files = dt.files;

            const url = URL.createObjectURL(convertedFile);
            $thumb.html(`<img src="${url}" alt="preview">`);
        });
    }

    return { bind };

})();
