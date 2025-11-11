const TableModule = (() => {

    function bindImgPreview(selector = ".table-img-thumb") {
        let $preview = $('<div class="thumb-preview-wrapper"><img class="thumb-preview" /></div>')
            .appendTo("body").hide();

        const $img = $preview.find("img");

        $(document).on("mouseenter", selector, function () {
            const src = $(this).attr("src");
            $img.attr("src", src);
            $preview.fadeIn(120);
        });

        $(document).on("mousemove", selector, function (e) {
            $preview.css({
                top: e.pageY + 20,
                left: e.pageX + 20
            });
        });

        $(document).on("mouseleave", selector, function () {
            $preview.fadeOut(150);
        });
    }

    function bindDelete(callback) {
        $(document).on("click", ".btn-action.delete", function () {
            const row = $(this).closest("tr");
            const id = row.data("id");
            if (confirm("¿Eliminar este registro?")) callback(id, row);
        });
    }

    return { bindImgPreview, bindDelete };

})();
