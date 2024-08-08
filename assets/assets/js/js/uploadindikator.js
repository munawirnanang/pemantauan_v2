$(document).ready(function() {
    $('.edit-btn').click(function() {
        var constraint = $(this).data('constraint');
        console.log(constraint);
        var id = $(this).data('id');
        var group = $(this).data('group');
        var nama = $(this).data('nama');
        var tabel = $(this).data('tabel');
        var jenis = $(this).data('jenis');
        var chart = $(this).data('chart');
        var link = $(this).data('link');
        var satuan = $(this).data('satuan');
        var urutan = $(this).data('urutan');
        var ppd = $(this).data('ppd');
        var deskripsi = $(this).data('deskripsi');

        if(constraint===0){
            $('#id_edit').attr('readonly','readonly');
            $('#keterangan').append('<small class="text-danger pl-3">Jumlah nilai indikator > 0 </small>')
        }
        
        $('#id_edit').val(id);
        $('#group_id_edit').val(group);
        $('#nama_indikator_edit').val(nama);
        $('#nama_tabel_edit').val(tabel);
        $('#jenis_edit').val(jenis);
        $('#chart_edit').val(chart);
        $('#link_edit').val(link);
        $('#satuan_edit').val(satuan);
        $('#urutan_edit').val(urutan);
        $('#ppd_edit').val(ppd);
        $('#deskripsi_edit').val(deskripsi);
        
        $('#modal-edit form').attr('action', base_url + 'edit_indikator2/' + id);
        $('#modal-edit').on('hide.bs.modal', function () {
            $('#id_edit').removeAttr('disabled');
            $('#keterangan').empty();
        });
    });

    $('.undo-btn').click(function() {
        var id = $(this).data('api');
        var nama = $(this).data('nama');
        
        $('#loading-animation').show();
        console.log(id)
        console.log(nama)
        $.ajax({
            url: base_url+'reset_data_indikator2/'+id,
            method: 'POST',
            success: function(data){
                console.log(data);
                $('#loading-animation').hide();
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                
                $('#loading-animation').hide();
              }
        })

    });

    $("#filer_input1").filer({
        limit: 1,
        maxSize: null,
        extensions: null,
        changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag & Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn btn btn-custom waves-effect waves-light">Browse Files</a></div></div>',
        showThumbs: true,
        theme: "dragdropbox",
        templates: {
            box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
            item: '<li class="jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-info">\
                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        <span class="jFiler-item-others">{{fi-size2}}</span>\
                                    </div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <li>{{fi-progressBar}}</li>\
                                    </ul>\
                                </div>\
                            </div>\
                        </div>\
                    </li>',
            itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                            <span class="jFiler-item-others">{{fi-size2}}</span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
                                        </ul>\
                                    </div>\
                                </div>\
                            </div>\
                        </li>',
            progressBar: '<div class="bar"></div>',
            itemAppendToEnd: false,
            removeConfirmation: true,
            _selectors: {
                list: '.jFiler-items-list',
                item: '.jFiler-item',
                progressBar: '.bar',
                remove: '.jFiler-item-trash-action'
            }
        },
        dragDrop: {
            dragEnter: null,
            dragLeave: null,
            drop: null,
        },
        files: [],
        addMore: false,
        clipBoardPaste: true,
        excludeName: null,
        beforeRender: null,
        afterRender: null,
        beforeShow: null,
        beforeSelect: null,
        afterShow: null,
        onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl){
            var file = file.name;
            $.post(base_url+"hapus_upload", {file: file});
        },
        onEmpty: null,
        options: null,
        captions: {
            button: "Choose Files",
            feedback: "Choose files To Upload",
            feedback2: "files were chosen",
            drop: "Drop file here to Upload",
            removeConfirmation: "Are you sure you want to remove this file?",
            errors: {
                filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
                filesType: "Only Images are allowed to be uploaded.",
                filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
                filesSizeAll: "Files you've chosen are too large! Please upload files up to {{fi-maxSize}} MB."
            }
        }
    });

    $('#filer_input1').on('change', function() {
        uploadFiles();
    });

    function uploadFiles() {
        var formData = new FormData($('#uploadForm')[0]);
        
        $('#loading-animation').show();
        $.ajax({
            url: base_url+"input_upload",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if(response.status==="error"){
                    let cleanedMessage = response.message.error.replace(/<\/?p>/g, '');
                    Swal.fire({
                        title: "Gagal",
                        text: cleanedMessage,
                        icon: "error"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                    $('#loading-animation').hide();
                }else{
                    var row = '<tr>' +
                            '<td>' + response.item.file_name + '</td>' +
                            '<td>' + response.item.file_size + ' KB</td>' +
                            '<td>' + response.item.up_dt + '</td>' +
                            '<td>' + response.item.up_by + '</td>' +
                            '<td>' +
                            '<button class="btn btn-icon btn-rounded waves-effect waves-light btn-teal m-b-5" onclick="location.reload();"><i class="fa fa-refresh"></i></button>' +
                            '</td>' +
                            '</tr>';
                    path = response.item.file;
                    id = response.item.id;
                    id_indikator = response.item.id_indikator
                    $.ajax({
                        url: base_url+"import",
                        type: "POST",
                        data: {id: id,
                                uploaded_id_indikator: id_indikator,
                                path: path},
                        success: function(response){
                            if(response.status==="error"){
                                Swal.fire({
                                    title: "Gagal",
                                    text: response.message,
                                    icon: "error"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            }else{
                                Swal.fire({
                                    title: "Berhasil",
                                    text: "Data Berhasil Import",
                                    icon: "success"
                                  }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                                console.log('Import Success!');
                                $('#indikator-table-body').prepend(row);
                            }
                            
                            $('#loading-animation').hide();
                        },
                        error: function(response) {
                            console.log('Import failed!');
                            $('#loading-animation').hide();
                        }
                    })
                }
            },
            error: function(response) {
                console.log('Upload failed!');
                
                $('#loading-animation').hide();
            }
        });
    }    
});