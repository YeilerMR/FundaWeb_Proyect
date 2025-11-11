$(document).ready(function () {
    $('table.table-custom').each(function () {
        initDataTable(this);
        TableModule.bindImgPreview(".table-img-thumb");
    });
});

function initDataTable(selector) {
    const isMobile = $(window).width() < 768;

    if (isMobile) return;

    const $table = $(selector);

    if (!$table.length) return; // evitar error si no existe

    const dt = $table.DataTable({
        paging: true,
        searching: true,
        info: false,
        lengthChange: true,
        pageLength: 5,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
        language: {
            lengthMenu: "_MENU_ registros por página",
            search: "Buscar:",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "No hay registros disponibles",
            paginate: {
                first: "«",
                last: "»",
                next: "›",
                previous: "‹"
            }
        },
        layout: {
            topStart: null,
            top: 'search',
            topEnd: 'pageLength',
            bottomEnd: 'paging'
        }
    });

    const wrapper = $table.closest('.dt-container');
    wrapper.find('.dt-search input[type="search"]').attr('placeholder', 'Buscar...');

    wrapper.find('.row.mt-2.justify-content-between > .col-md-auto.ms-auto')
        .addClass('col-12');
        
    wrapper.find('.dt-length label').contents().filter(function () {
        return this.nodeType === 3;
    }).remove();
    return dt;
}
