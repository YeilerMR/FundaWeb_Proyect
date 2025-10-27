// Módulo: Categorías (modal + chips) — dinámico desde Blade
const CategoriesModule = (() => {

    let ALL = [];
    let selectedCatIds = new Set();
    let $chips, $hiddenCats, $list, $search, $modal, modalInstance;

    function init() {
        if (!window.__CATEGORIES_DATA__) return;

        ALL = window.__CATEGORIES_DATA__.map(c => ({
            id: String(c.id),
            name: c.name
        }));

        $modal = $("#categoriesModal");
        if ($modal.length === 0) return;

        modalInstance = new bootstrap.Modal($modal[0]);
        $chips = $("#selectedCategories");
        $hiddenCats = $("#categoriesHidden");
        $list = $("#categoriesList");
        $search = $("#categoriesSearch");

        bindEvents();
        renderList();
    }

    function bindEvents() {
        $("#btnOpenCategories").on("click", () => {
            renderList();
            modalInstance.show();
            setTimeout(() => $search.trigger("focus"), 200);
        });

        $("#btnClearCategories").on("click", () => {
            selectedCatIds.clear();
            sync();
        });

        $search.on("input", () => renderList($search.val()));

        $list.on("change", ".cat-check", function () {
            const id = this.value;
            if (this.checked) selectedCatIds.add(id);
            else selectedCatIds.delete(id);
        });

        $("#btnSaveCategories").on("click", () => {
            sync();
            modalInstance.hide();
        });

        $chips.on("click", ".chip-remove", function () {
            const id = $(this).closest(".chip").data("id");
            selectedCatIds.delete(String(id));
            sync();
        });
    }

    function renderList(filter = "") {
        const f = filter.trim().toLowerCase();
        const items = ALL
            .filter(c => c.name.toLowerCase().includes(f))
            .map(c => `
                <label class="category-item">
                    <input type="checkbox" class="cat-check" value="${c.id}"
                        ${selectedCatIds.has(String(c.id)) ? "checked" : ""}>
                    <span>${c.name}</span>
                </label>
            `)
            .join("");
        $list.html(items || `<div class="text-secondary">Sin resultados.</div>`);
    }

    function sync() {
        const chips = [...selectedCatIds].map(id => {
            const c = ALL.find(x => x.id == id);
            return `
                <span class="chip" data-id="${c.id}">
                    <i class="bi bi-tag"></i>${c.name}
                    <button type="button" class="chip-remove"><i class="bi bi-x"></i></button>
                </span>`;
        }).join("");

        $chips.html(chips);

        $hiddenCats.html(
            [...selectedCatIds]
                .map(id => `<input type="hidden" name="categories[]" value="${id}">`)
                .join("")
        );
    }

    function setSelected(ids = []) {
        selectedCatIds = new Set(ids.map(String));
        sync();
        renderList($search.val());
    }

    function getSelectedIds() {
        return [...selectedCatIds];
    }

    return { init, setSelected, getSelectedIds };
})();