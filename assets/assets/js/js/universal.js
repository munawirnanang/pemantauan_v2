/*
 * common properties
 */


var base_url    = window.location.origin + '/';
    base_url   += "WWW/pemantauan_arvin_v8/";

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

    function addToFolder(id) {

        // Your logic to add the document to the folder goes here
        // alert("Document ID to add: " + id);

        if($("#download-"+id).hasClass("addFile")){
            $("#download-"+id).html("Ditambahkan");
            $("#download-"+id).removeClass("btn-inverse");
            $("#download-"+id).addClass("btn-teal");
            $("#download-"+id).removeClass("addFile");
            $("#download-"+id).addClass("addedFile");
            cartFile('add', id);
        }else{
            $("#download-"+id).html("Tambah Ke Folder");
            $("#download-"+id).addClass("btn-inverse");
            $("#download-"+id).removeClass("btn-teal");
            $("#download-"+id).addClass("addFile");
            $("#download-"+id).removeClass("addedFile");
            cartFile('remove', id);
        }

    }

    var cart = [];
    function cartFile(param ,id) {
        if (param == 'add') {
            cart.push(id);
            // alert(cart+' (count : '+cart.length+')');
            $(".folderFile").html(cart.length);
            $(".btnUnduhDok").attr("data-dokumen", cart);
        }else if (param == 'remove') {
            var removeItem = id;
            cart = jQuery.grep(cart, function(value) {
                return value != removeItem;
            });
            // alert(cart+' (count : '+cart.length+')');
            $(".folderFile").html(cart.length);
            $(".btnUnduhDok").attr("data-dokumen", cart);
        }
    }

    $(".btnUnduhDok").on('click', function() {
        $('.icon').append('<i class="fa fa-spin fa-refresh refreshIcon"></i>');
        var dataValue = $(this).attr('data-dokumen');
        var dataArray = dataValue.split(',');
        var link = base_url + "/show_doc"; // base_url from universal.js
        var dokumenArray = [];
        
        $.get(link, function(data) {
            var json = $.parseJSON(data);
            var num = 0;
            while (num < dataArray.length) {
                var num2 = 0;
                while (num2 < json.length) {
                    if (dataArray[num] == json[num2].id) {
                        dokumenArray.push({
                            dokName: json[num2].DokName,
                            link: json[num2].link
                        });
                        num2 = json.length; // Exit inner loop
                    }
                    num2++;
                }
                num++;
            }
    
            // Convert dokumenArray to a JSON string
            var dokumenArrayJson = JSON.stringify(dokumenArray);
    
            // Create a form and submit it
            var form = document.createElement("form");
            form.style.display = "none";
            form.method = "POST";
            form.action = base_url + "zipDok/";
    
            // Hidden input for JSON data
            var input = document.createElement("input");
            input.type = "hidden";
            input.name = "dokumenArray";
            input.value = dokumenArrayJson;
    
            form.appendChild(input);
            document.body.appendChild(form);
    
            form.submit();
            $('.refreshIcon').remove();
        })
        .fail(function() {
            alert("Error retrieving document data.");
        });
    });
    
    