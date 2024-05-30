$(document).ready(function() {
    $('.detail-link').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        $('#loading-animation').show();
        $.ajax({
            type: "POST",
            url: base_url+"detail_data",
            data: { id: id },
            success: function(response) {
                
                $('#loading-animation').hide();
                console.log(response);
                $('#cari-b1').html(response);
                $('#datatable-buttons').DataTable({
                    dom: 'Blfrtip',
                    lengthMenu: [10, 25, 50, 75, 100], // Options for number of entries per page
                    buttons: [
                        'copy', 'excel', 'pdf', 'print'
                    ],
                });
                $('.nav-tabs a[href="#cari-b1"]').tab('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                
                $('#loading-animation').hide();
            }
        });
    });

    // form_handler.js
    $('.btn-submit').click(function(event) {
        event.preventDefault();

        // Manually submit the form
        $('#indikatorform').submit();
    });

    $('#indikatorform').submit(function(event) {
        event.preventDefault();

        $('#loading-animation').show();

        var formData = {
            wilayah: $('#wilayah').val(),
            indikator: $('#indikator').val(),
            tahun: $('#tahun').val()
        };
        $.ajax({
            url: base_url+"show_data",
            method: 'POST',
            data: formData,
            success: function(response) {
                table = response;
                console.log(table);
                $('#tabel_indikator').html(table);

                $('#loading-animation').hide();
                
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);

                $('#loading-animation').hide();
            }
        });
    });



});
