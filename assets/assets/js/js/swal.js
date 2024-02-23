$(document).ready(function() {
    const flashData = $('.flash-data').data('flashdata');
    if (flashData) {
      Swal.fire({
        title: "Berhasil",
        text: "Data Berhasil "+flashData,
        icon: "success"
      })
    }
});

$(document).ready(function() {
  $(document).on('click', '#hapus', function() {
    var namaHapus = $(this).attr('nama-hapus');
    var id = $(this).attr('id-hapus');
    var controller = $(this).attr('action');
    console.log(controller);
    
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger"
      },
      buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
      title: "Apakah anda yakin?",
      text: "Data "+namaHapus+" akan dihapus",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Ya, Hapus",
      cancelButtonText: "Tidak, Batal",
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
          $.ajax({
            url: base_url+controller,
            type: 'POST',
            data: {
                id: id,
            },
            success: function(response){
            },
            error: function(xhr, status, error) {
              console.error(xhr.responseText);
            }
          });
          swalWithBootstrapButtons.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
          });
          location.reload();
        } 
      });
    });
});
    