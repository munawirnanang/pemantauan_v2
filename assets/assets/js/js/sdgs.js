$(document).ready(function() {
    $('#nav-list').hide();
    $('#card-title').hide();
    $('#card-item').hide();
    $('.goal-link').click(function(event) {
        
        $('#loading-animation').show();
        event.preventDefault(); // Prevent the default action of the link
        
        var goal = $(this).data('goal'); // Get the goal data attribute
        
        $.ajax({
            url: base_url+'get_goal', // Update with your controller/method
            type: 'POST',
            data: { goal: goal },
            success: function(response) {
                $('#nav-list').show();
                $('#card-title').show();
                $('#card-item').show();
                $('.nav-tabs a[href="#data-b1"]').tab('show');
                $('#card-title').empty();
                $('#card-item').empty();
                $('#cari-b1').empty();
                $('#loading-animation').hide();
                $('#tabel_sdgs').html(response);$('.detail-link').click(function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    console.log(id);
                    
                    $('#loading-animation').show();
                    $.ajax({
                        type: "POST",
                        url: base_url+"detail_sdgs",
                        data: { id: id,
                         },
                        success: function(response) {
                            console.log(response);
                            $('#loading-animation').hide();
                            $('#card-title').html(response.html_title);
                            $('#card-item').html(response.html_card);
                            $('#cari-b1').html(response.html_table);
                            $('#datatable-buttons').DataTable({
                                dom: 'Blfrtip',
                                pageLength: 50,
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
            },
            error: function(xhr, status, error) {
                // Handle any errors here
                console.error(error);
            }
        });
    });
});
