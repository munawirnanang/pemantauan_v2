$(document).ready(function() {
    $('#selectWilayah').on('change', function() {
        var href = $(this).find('option:selected').data('href');
        console.log(href);
        if (href) {
            window.location.href = href;
        }
    });

    function fetchData(id, uri) {
        $('#loading-animation').show();
        $.ajax({
            type: "GET",
            url: base_url + "detail_data",
            data: { 
                id: id,
                uri: uri 
            },
            success: function(response) {
                $('#loading-animation').hide();
                $('#cari-b1').html(response);
                $('#datatable-buttons').DataTable({
                    dom: 'Blfrtip',
                    pageLength: 50,
                    lengthMenu: [10, 25, 50, 75, 100],
                    buttons: [
                        'excel', 'csv', 'pdf', 'print'
                    ],
                });
                $('#convert').click(function(){
                    var table_content = '<table>';
                    table_content += $('#datatable-buttons').html();
                    table_content += '</table>';
                    $('#file_content').val(table_content);
                    $('#convert_form').submit();
                });
                $('.nav-tabs a[href="#cari-b1"]').tab('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $('#loading-animation').hide();
            }
        });
    }

    // Handle link clicks
    $('.detail-link').click(function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        var urlParams = new URLSearchParams(href.split('?')[1]);
        var id = urlParams.get('id');
        var uri = urlParams.get('uri');

        // Update the URL
        history.pushState(null, '', href);

        // Fetch data
        fetchData(id, uri);
    });

    // Handle direct access to the URL
    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('id');
    var uri = urlParams.get('uri');
    if (id && uri) {
        fetchData(id, uri);
    } 
        
});
