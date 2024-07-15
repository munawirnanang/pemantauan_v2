$(document).ready(function() {
    $('#selectWilayah').on('change', function() {
        var href = $(this).find('option:selected').data('href');
        console.log(href);
        if (href) {
            window.location.href = href;
        }
    });

    $('.detail-link').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var uri = $(this).data('uri');
        
        $('#loading-animation').show();
        $.ajax({
            type: "POST",
            url: base_url+"detail_data",
            data: { id: id,
                    uri: uri
             },
            success: function(response) {
                $('#loading-animation').hide();
                console.log(response);
                $('#cari-b1').html(response);
                $('#datatable-buttons').DataTable({
                    dom: 'Blfrtip',
                    lengthMenu: [10, 25, 50, 75, 100],
                    buttons: [
                        'excel', 'pdf', 'print'
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
});