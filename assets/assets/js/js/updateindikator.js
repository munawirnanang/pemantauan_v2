
$(document).ready(function() {
    $('.refresh-btn').click(function() {
        var id = $(this).data('api');
        var nama = $(this).data('nama');
        
        $('#loading-animation').show();
        console.log(id)
        console.log(nama)
        $.ajax({
            url: base_url+'update_data_indikator/'+id,
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
    $('.undo-btn').click(function() {
        var id = $(this).data('api');
        var nama = $(this).data('nama');
        
        $('#loading-animation').show();
        console.log(id)
        console.log(nama)
        $.ajax({
            url: base_url+'reset_data_indikator/'+id,
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
});
$(document).ready(function() {
    $('.edit-btn').click(function() {
        var constraint = $(this).data('constraint');
        console.log(constraint);
        var id = $(this).data('id');
        var api = $(this).data('api');
        var turvar = $(this).data('turvar');
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
        $('#id_bps_edit').val(api);
        $('#id_turvar_edit').val(turvar);
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
        
        $('#modal-edit form').attr('action', base_url + 'edit_indikator/' + id);
        $('#modal-edit').on('hide.bs.modal', function () {
            $('#id_edit').removeAttr('disabled');
            $('#keterangan').empty();
        });
    });
});
$(document).ready(function() {
    $('.btn-refresh-all').click(function() {

        $('#loading-animation').show();
        $.ajax({
            url: base_url+'update_all_indikator/',
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
});
