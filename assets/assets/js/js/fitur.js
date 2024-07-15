$(document).ready(function() {

    list_fitur();

    function list_fitur() {
        $('#table_fitur').DataTable().destroy();
        $.ajax({
            type: "GET",
            url: base_url+"/list_fitur", //base_url from universal.js
            dataType: "json",
            success: function(result) {
                console.log(result);
                var data = result;
                $('#table_fitur').DataTable( {
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

    var tambah_fitur = $("#tambah_fitur");
    tambah_fitur.validate({
        rules: {
            nama: "required",
        },
        submitHandler: function() {
            // console.log(tambah_role.serializeArray());
            var modalBodyNotif = $("#con-close-modal").find("[id$=notif]");
            modalBodyNotif.html("");
            $.ajax({
                type: "POST",
                url: base_url+"/tambah_fitur", //base_url from universal.js
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
                        list_fitur();
                        $('#tambah_fitur')[0].reset();
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
        $('#editid').val(id);
        $('#editnama').val(nama);
        $('#editfitur').val(fitur);
    });

    var ubah_fitur = $("#ubah_fitur");
    ubah_fitur.validate({
        rules: {
            editid: "required", 
            editnama: "required",
        },
        submitHandler: function() {
            var modalBodyNotif = $("#modal-edit").find("[id$=notif]");
            modalBodyNotif.html("");
            $.ajax({
                type: "POST",
                url: base_url+"/ubah_fitur", //base_url from universal.js
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
                        list_fitur();
                        $('#ubah_fitur')[0].reset();
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
                    url: base_url+"/hapus_fitur", //base_url from universal.js
                    dataType: "json",
                    data: {id: idhapus},
                    success: function(result) {
                        console.log(result);
                        if (result['status'] == 'error') {
                            toastr["error"]("Gagal menghapus data fitur");
                        }else if(result['status'] == 'sukses') {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                            list_fitur();
                            $('#ubah_fitur')[0].reset();
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

