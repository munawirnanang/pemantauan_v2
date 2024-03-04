jQuery(document).ready(function($) {
    $('input[type="checkbox"]').change(function() {
        var fitur = $(this).val();
        var role = $(this).closest('tr').find('#id_user').val();
        var ceklis = $(this).prop('checked');

        $.ajax({
            url: base_url+'update_role',
            type: 'POST',
            data: {
                fitur: fitur,
                role: role,
                ceklis: ceklis
            },
            success: function(response) {
                toastr["success"](" ", "Data berhasil Diperbaharui")
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "1000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                  }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

$(document).ready(function() {
    $(document).on('click', '.edit-btn', function() {
        var namaEdit = $(this).attr('nama-edit');
        var idEdit = $(this).attr('id-edit');


        $('#editnama').val(namaEdit);
        
        // You can use the baseUrl variable here
        $('#modal-edit form').attr('action', base_url + 'edit_role/' + idEdit);
    });
});

