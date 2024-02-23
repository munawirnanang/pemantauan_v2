
$(document).ready(function() {
    $('.edit-btn').click(function() {
        var id = $(this).data('edit');
        var nama = $(this).data('nama');

        $('#editnama').val(nama);
        
        $('#modal-edit form').attr('action', base_url + 'edit_fitur/' + id);
    });
});
