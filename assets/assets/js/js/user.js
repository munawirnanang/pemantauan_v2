
$(document).ready(function() {
    $('.edit-btn').click(function() {
        var id = $(this).data('edit');
        var userid = $(this).data('userid');
        var email = $(this).data('email');
        var nama = $(this).data('nama');
        var role = $(this).data('role');

        $('#edituserid').val(userid);
        $('#editemail').val(email);
        $('#editnama').val(nama);
        $('#editrole').val(role);
        // Refresh the selectpicker
        $('.selectpicker').selectpicker('refresh');
        
        $('#modal-edit form').attr('action', base_url + 'edit_user/' + id);
    });
});
