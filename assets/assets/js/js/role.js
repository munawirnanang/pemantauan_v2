$(document).ready(function() {

    console.log(base_url);
    list_role();

    function list_role(){
        $('#table_role').DataTable().destroy();
        $.ajax({
            type: "GET",
            url: base_url+"/list_role", //base_url from universal.js
            dataType: "json",
            success: function(result) {
                console.log(result);
                var data = result;
                $('#table_role').DataTable( {
                    data: data,
                    columns: [
                        { data: 0 },
                        { data: 2 },
                        { data: 3 },
                        { data: 4 },
                    ],
                    dom: 'Bfrtip', // l for length changing input, B for buttons, f for filtering input, r for processing display element, t for table, i for table information summary, p for pagination control, additional options can be added as needed
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                });
            },
            error: function(result) {
                console.log(result);
            }
        });
    }

    var tambah_role = $("#tambah_role");
    tambah_role.validate({
        rules: {
            nama: "required",
            fitur: "required",
        },
        submitHandler: function() {
            // console.log(tambah_role.serializeArray());
            var modalBodyNotif = $("#con-close-modal").find("[id$=notif]");
            modalBodyNotif.html("");
            $.ajax({
                type: "POST",
                url: base_url+"/tambah_role", //base_url from universal.js
                dataType: "json",
                data: {
                    nama : $('#nama').val(),
                    fitur: $('#fitur').val(),
                    csrf: $('#csrf').val(),
                },
                success: function(result) {
                    // Select the modal body element
                    console.log(result);
                    // console.log(result['status']);
                    if (result['status'] == 'error') {
                        result['desc'].forEach(element => {
                            // console.log(element['id']);
                            var modalBody = $("#con-close-modal").find("#"+element['id']+"notif");
                            modalBody.append(element['message']);
                        });
                    }else if(result['status'] == 'sukses') {
                        $('#con-close-modal').modal('hide');
                        toastr["success"]("Sukses menyimpan data role");
                        list_role();
                        $('#tambah_role')[0].reset();
                    }else{
                        console.log(result['status']);

                    }
                },
                error: function(result) {
                    console.log(result);
                }
            });
        }
    });

    $(document).on('click', '.edit-btn', function(){
        var id = $(this).data('id');
        var nama = $(this).data('edit');
        var fitur = $(this).data('fitur');
        console.log(fitur);
        $('#editid').val(id);
        $('#editnama').val(nama);
        // $('#editfitur').val(fitur);
        $("#editfitur").selectpicker('val', fitur);
    });

    var ubah_role = $("#ubah_role");
    ubah_role.validate({
        rules: {
            editid: "required", 
            editnama: "required",
        },
        submitHandler: function() {
            var modalBodyNotif = $("#modal-edit").find("[id$=notif]");
            modalBodyNotif.html("");
            $.ajax({
                type: "POST",
                url: base_url+"/ubah_role", //base_url from universal.js
                dataType: "json",
                data: {
                    editid : $('#editid').val(),
                    editnama: $('#editnama').val(),
                    editfitur: $('#editfitur').val(),
                },
                success: function(result) {
                    console.log(result);
                    if (result['status'] == 'error') {
                        result['desc'].forEach(element => {
                            // console.log(element['id']);
                            var modalBody = $("#modal-edit").find("#"+element['id']+"notif");
                            modalBody.append(element['message']);
                        });
                    }else if(result['status'] == 'sukses') {
                        $('#modal-edit').modal('hide');
                        toastr["success"]("Sukses mengubah data role");
                        list_role();
                        $('#ubah_role')[0].reset();
                    }else{
                        console.log(result['status']);

                    }
                },
                error: function(result) {
                    console.log(result);
                }
            });
        }
    });

    $(document).on('click', '.hapus-btn', function(){
        var idhapus = $(this).data('idhapus');
        // alert(idhapus);
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: base_url+"/hapus_role", //base_url from universal.js
                    dataType: "json",
                    data: {id: idhapus},
                    success: function(result) {
                        console.log(result);
                        if (result['status'] == 'error') {
                            toastr["error"]("Gagal menghapus data role");
                        }else if(result['status'] == 'sukses') {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                            list_role();
                            $('#ubah_role')[0].reset();
                        }else{
                            console.log(result['status']);
                        }
                    },
                    error: function(result) {
                        console.log(result);
                    }
                });
            }
        });
    });

});

// jQuery(document).ready(function($) {
//     $('input[type="checkbox"]').change(function() {
//         var fitur = $(this).val();
//         var role = $(this).closest('tr').find('#id_user').val();
//         var ceklis = $(this).prop('checked');

//         $.ajax({
//             url: base_url+'update_role',
//             type: 'POST',
//             data: {
//                 fitur: fitur,
//                 role: role,
//                 ceklis: ceklis
//             },
//             success: function(response) {
//                 toastr["success"](" ", "Data berhasil Diperbaharui")
//                 toastr.options = {
//                     "closeButton": true,
//                     "debug": false,
//                     "newestOnTop": false,
//                     "progressBar": true,
//                     "positionClass": "toast-top-right",
//                     "preventDuplicates": false,
//                     "onclick": null,
//                     "showDuration": "300",
//                     "hideDuration": "1000",
//                     "timeOut": "1000",
//                     "extendedTimeOut": "1000",
//                     "showEasing": "swing",
//                     "hideEasing": "linear",
//                     "showMethod": "fadeIn",
//                     "hideMethod": "fadeOut"
//                   }
//             },
//             error: function(xhr, status, error) {
//                 console.error(xhr.responseText);
//             }
//         });
//     });
// });

