window.UI = {

    showToast: function (type, message) {
        Swal.fire({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: type,
            title: message
        });
    },

    confirmAction: function (message, callback) {
        Swal.fire({
            title: 'Confirmación',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, continuar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then(function (result) {
            if (result.isConfirmed && typeof callback === 'function') {
                callback();
            }
        });
    },

    confirmUpdate: function (callback) {
        this.confirmAction('¿Deseas actualizar este registro? Esta acción no se puede deshacer.', callback);
    },

    confirmDelete: function (callback) {
        this.confirmAction('¿Deseas eliminar este registro? Esta acción no se puede deshacer.', callback);
    }

};

$(document).on('click', '.btn-action.delete', function (e) {
    e.preventDefault();

    var form = $(this).closest('form');

    UI.confirmDelete(function () {
        form.submit();
    });
});

$(document).on('submit', 'form', function (e) {

    let isEdit = $(this).find('input[name="_method"]').val() === 'PUT'
        || $(this).find('input[name="_method"]').val() === 'PATCH';

    if (isEdit) {
        e.preventDefault();
        let form = this;

        UI.confirmUpdate(function () {
            form.submit();
        });
    }
});