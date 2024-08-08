
$(document).ready(function() {

    list_user();

    function list_user(){
        $('#table_user').DataTable().destroy();
        $.ajax({
            type: "GET",
            url: base_url+"/list_user", //base_url from universal.js
            dataType: "json",
            success: function(result) {
                console.log(result);
                var data = result;
                $('#table_user').DataTable( {
                    data: data,
                    columns: [
                        { data: 0 },
                        { data: 2 },
                        { data: 3 },
                        { data: 4 },
                        { data: 5 },
                        { data: 6 },
                        { data: 7 },
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

    var tambah_user = $("#tambah_user");
    tambah_user.validate({
        rules: {
            userid: "required", 
            email: "required",
            nama: "required",
            role: "required",
        },
        submitHandler: function() {
            // console.log(tambah_user.serializeArray());
            var modalBodyNotif = $("#con-close-modal").find("[id$=notif]");
            modalBodyNotif.html("");
            $.ajax({
                type: "POST",
                url: base_url+"/tambah_user", //base_url from universal.js
                dataType: "json",
                data: tambah_user.serializeArray(),
                success: function(result) {
                    // Select the modal body element
                    // console.log(result);
                    // console.log(result['status']);
                    if (result['status'] == 'error') {
                        result['desc'].forEach(element => {
                            // console.log(element['id']);
                            var modalBody = $("#con-close-modal").find("#"+element['id']+"notif");
                            modalBody.append(element['message']);
                        });
                    }else if(result['status'] == 'sukses') {
                        $('#con-close-modal').modal('hide');
                        toastr["success"]("Sukses menyimpan data pengguna");
                        list_user();
                        $('#tambah_user')[0].reset();
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

    leftside();

    function leftside() {
        $.get( base_url+"/get_user", function(result) {
            var data = JSON.parse(result);
            $('#leftSideNama').html('');
            if (data['leftside'][0]['nama'].length <= 12) {
                $('#leftSideNama').append(data['leftside'][0]['nama']);
            }else{
                var str = data['leftside'][0]['nama'];
                var res = str.substring(0,12);
                res += '..';
                $('#leftSideNama').append(res);
            }
        })
        .fail(function() {
            alert( "error" );
        });
    }

    $(document).on('click', '.edit-btn', function(){
        var id = $(this).data('edit');
        var userid = $(this).data('userid');
        var email = $(this).data('email');
        var nama = $(this).data('nama');
        var role = $(this).data('role');
        $('#editid').val(id);
        $('#edituserid').val(userid);
        $('#editemail').val(email);
        $('#editnama').val(nama);
        $('#editrole').val(role);
        // Refresh the selectpicker
        $('.selectpicker').selectpicker('refresh');
    });

    var ubah_user = $("#ubah_user");
    ubah_user.validate({
        rules: {
            editid: "required", 
            edituserid: "required", 
            editemail: "required",
            editnama: "required",
            editrole: "required",
        },
        submitHandler: function() {
            // console.log(ubah_user.serializeArray());
            var modalBodyNotif = $("#modal-edit").find("[id$=notif]");
            modalBodyNotif.html("");
            $.ajax({
                type: "POST",
                url: base_url+"/ubah_user", //base_url from universal.js
                dataType: "json",
                data: ubah_user.serializeArray(),
                success: function(result) {
                    console.log(result);
                    if (result['status'] == 'error') {
                        result['desc'].forEach(element => {
                            // console.log(element['id']);
                            var modalBody = $("#modal-edit").find("#"+element['id']+"notif");
                            modalBody.append(element['message']);
                        });
                    }else if(result['status'] == 'sukses') {
                        leftside();
                        $('#modal-edit').modal('hide');
                        toastr["success"]("Sukses mengubah data pengguna");
                        list_user();
                        $('#ubah_user')[0].reset();
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
                    url: base_url+"/hapus_user", //base_url from universal.js
                    dataType: "json",
                    data: {id: idhapus},
                    success: function(result) {
                        console.log(result);
                        if (result['status'] == 'error') {
                            toastr["error"]("Gagal menghapus data pengguna");
                        }else if(result['status'] == 'sukses') {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                            list_user();
                            $('#ubah_user')[0].reset();
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
