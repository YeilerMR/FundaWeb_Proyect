// Módulo: Image Preview (para inputs de una sola imagen)
const ImagePreviewModule = (() => {

    function bind($input, $thumb) {
        $input.on("change", function (e) {
            const file = e.target.files?.[0];
            if (!file) return;
            
            if (!ImageValidator.validateFile(file)) {
                $input.val("");
                $thumb.html("");
                return;
            }

            const url = URL.createObjectURL(file);
            $thumb.html(`<img src="${url}" alt="preview">`);
        });
    }

    return { bind };

})();
