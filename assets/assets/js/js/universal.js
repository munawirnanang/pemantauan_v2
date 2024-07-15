/*
 * common properties
 */

var base_url    = window.location.origin + '/';
    base_url   += "WWW/pemantauan_arvin_v5/";

    $(document).ready(function() {

        leftside();

        function leftside() {
            $.get( base_url+"/get_user", function(result) {
                var data = JSON.parse(result);
                console.log(data);
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

        $(document).on('click', '.edit-btn-profil', function(){
            $.get( base_url+"/get_user", function(result) {
                var data = JSON.parse(result);
                // console.log(data['leftside'][0]['id']);

                $('#profilid').val(data['leftside'][0]['id']);
                $('#profiluserid').val(data['leftside'][0]['userid']);
                $('#profilemail').val(data['leftside'][0]['email']);
                $('#profilnama').val(data['leftside'][0]['nama']);
                $('#profilrole').val(data['leftside'][0]['role']);
            })
            .fail(function() {
                alert( "error" );
            });
        });

        var ubah_profil = $("#ubah_profil");
        ubah_profil.validate({
            rules: {
                editid: "required", 
                edituserid: "required", 
                editemail: "required",
                editnama: "required",
                editrole: "required",
            },
            submitHandler: function() {
                var modalBodyNotif = $("#modal-profil").find("[id$=notif]");
                modalBodyNotif.html("");
                $.ajax({
                    type: "POST",
                    url: base_url+"/ubah_user", //base_url from universal.js
                    dataType: "json",
                    data: ubah_profil.serializeArray(),
                    success: function(result) {
                        console.log(result);
                        if (result['status'] == 'error') {
                            result['desc'].forEach(element => {
                                // console.log(element['id']);
                                var modalBody = $("#modal-profil").find("#profil"+element['id']+"notif");
                                modalBody.append(element['message']);
                            });
                        }else if(result['status'] == 'sukses') {
                            leftside();
                            $('#modal-profil').modal('hide');
                            toastr["success"]("Sukses mengubah data pengguna");
                            $('#ubah_profil')[0].reset();
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

        var ubah_pass = $("#ubah_password");
        ubah_pass.validate({
            rules: {
                editpassid: "required", 
                currentpassword: "required", 
                newpassword: "required", 
                repeatnewpassword: "required",
            },
            submitHandler: function() {
                console.log(ubah_pass.serializeArray());
                var modalBodyNotif = $("#modal-password").find("[id$=notif]");
                modalBodyNotif.html("");
                $.ajax({
                    type: "POST",
                    url: base_url+"/ubah_pass", //base_url from universal.js
                    dataType: "json",
                    data: ubah_pass.serializeArray(),
                    success: function(result) {
                        console.log(result);
                        if (result['status'] == 'error') {
                            result['desc'].forEach(element => {
                                // console.log(element['id']);
                                var modalBody = $("#modal-password").find("#edit"+element['id']+"notif");
                                modalBody.append(element['message']);
                            });
                        }else if(result['status'] == 'sukses') {
                            $('#modal-password').modal('hide');
                            toastr["success"]("Sukses mengubah data pengguna");
                            $('#ubah_password')[0].reset();
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

    function seeCurrPass() {
        // alert("sukses");
        var x = document.getElementById("currentpassword");
        var iconCurrPass = document.getElementById("iconCurrPass");
        if (x.type === "password") {
          x.type = "text";
          iconCurrPass.classList.remove("fa-eye");
          iconCurrPass.classList.add("fa-eye-slash");
        } else {
          x.type = "password";
          iconCurrPass.classList.remove("fa-eye-slash");
          iconCurrPass.classList.add("fa-eye");
        }
    }

    function seeNewPass() {
        // alert("sukses");
        var x = document.getElementById("newpassword");
        var iconNewPass = document.getElementById("iconNewPass");
        if (x.type === "password") {
          x.type = "text";
          iconNewPass.classList.remove("fa-eye");
          iconNewPass.classList.add("fa-eye-slash");
        } else {
          x.type = "password";
          iconNewPass.classList.remove("fa-eye-slash");
          iconNewPass.classList.add("fa-eye");
        }
    }

    function seeRepeatNewPass() {
        // alert("sukses");
        var x = document.getElementById("repeatnewpassword");
        var iconRepeatNewPass = document.getElementById("iconRepeatNewPass");
        if (x.type === "password") {
          x.type = "text";
          iconRepeatNewPass.classList.remove("fa-eye");
          iconRepeatNewPass.classList.add("fa-eye-slash");
        } else {
          x.type = "password";
          iconRepeatNewPass.classList.remove("fa-eye-slash");
          iconRepeatNewPass.classList.add("fa-eye");
        }
    }