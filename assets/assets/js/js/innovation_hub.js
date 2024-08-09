$(document).ready(function() {

    getDoc();

    function getDoc() {
        var link = base_url+"/show_innovation_doc"; //base_url from universal.js;
        $.get(link, function(data, status){
        var json = $.parseJSON(data);
        // console.log(json);
        var dataSet2 = json;
        // console.log(dataSet2);

        function filterGlobal(table) {
            table
                .search(
                    $('#global_filter').val(),
                    $('#global_regex').prop('checked'),
                    $('#global_smart').prop('checked')
                )
                .draw();
        }
        
        function filterColumn(table, i) {
            table
                .column(i)
                .search(
                    $('#col' + i + '_filter').val(),
                    $('#col' + i + '_regex').prop('checked'),
                    $('#col' + i + '_smart').prop('checked')
                )
                .draw();
        }

        // Formatting function for row details - modify as you need
        function format(d) {
            // `d` is the original data object for the row
            return (
                '<dl>' +
                    '<div class="row" style="display: flex;">' +
                        '<div class="col-4" style="width: 20%;">' +
                            '<dt style="margin-left: 30px;">' +
                                'Deskripsi' +
                            '</dt>' +
                        '</div>' +
                        '<div class="col-8" style="width: 80%;">' +
                            '<dd>' +
                                d.Deskripsi +
                            '</dd>' +
                        '</div>' +
                    '</div>' +
                    '<div class="row" style="display: flex;">' +
                        '<div class="col-4" style="width: 20%;">' +
                            '<dt style="margin-left: 30px;">' +
                                'Input' +
                            '</dt>' +
                        '</div>'+
                        '<div class="col-8" style="width: 80%;">' +
                            '<dd>' +
                                d.Input +
                            '</dd>' +
                        '</div>' +
                    '</div>' +
                    '<div class="row" style="display: flex;">' +
                        '<div class="col-4" style="width: 20%;">' +
                            '<dt style="margin-left: 30px;">' +
                                'Proses' +
                            '</dt>' +
                        '</div>' +
                        '<div class="col-8" style="width: 80%;">' +
                            '<dd>' +
                                d.Proses +
                            '</dd>' +
                        '</div>' +
                    '</div>' +
                    '<div class="row" style="display: flex;">' +
                        '<div class="col-4" style="width: 20%;">' +
                            '<dt style="margin-left: 30px;">' +
                                'Output' +
                            '</dt>' +
                        '</div>' +
                        '<div class="col-8" style="width: 80%;">' +
                            '<dd>' +
                                d.Output +
                            '</dd>' +
                        '</div>' +
                    '</div>' +
                    '<div class="row" style="display: flex;">' +
                        '<div class="col-4" style="width: 20%;">' +
                            '<dt style="margin-left: 30px;">' +
                                'Outcome' +
                            '</dt>' +
                        '</div>' +
                        '<div class="col-8" style="width: 80%;">' +
                            '<dd>' +
                                d.Outcome +
                            '</dd>' +
                        '</div>' +
                    '</div>' +
                '</dl>'
            );
        }

        var table = $('#example').DataTable({
            data: dataSet2,
            columns: [
                {
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                { data: 'Nama Dokumen' },
                { data: 'Judul' },
                { data: 'Tag' },
                { data: 'Tahun' },
                { data: 'Instansi' },
                { data: 'Aksi' }
            ],
            columnDefs: [
                { width: '0.1%', targets: 0 },
                { width: '24.9%', targets: 1 },
                { width: '25%', targets: 2 },
                { width: '13%', targets: 3 },
                { width: '7%', targets: 4 },
                { width: '15%', targets: 5 },
                { width: '15%', targets: 6 }
            ],
            autoWidth: false,  // Disable automatic column width calculation
            order: [[1, 'asc']],
            dom: 'lrtip',
            buttons: [
                'copy', 'excel', 'pdf' // Specify which buttons you want to include
            ],
            aLengthMenu: [
                [5, 10, 25, 50, 100, 200, -1],
                [5, 10, 25, 50, 100, 200, "All"]
            ],
            iDisplayLength: 10,
            drawCallback: function(settings) {
                // Append icon to control column in each row
                $('#example tbody tr').each(function() {
                    $(this).find('td.dt-control').html('<i class="fa fa-plus-circle" style="float: right;"></i>');
                });
            }
        });
        
        // Add event listener for opening and closing details
        $('#example tbody').on('click', 'td.dt-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            tr.toggleClass("activated");
            
            if (tr.hasClass("activated")) {
                tr.find(".dt-control > i.fa-plus-circle").removeClass("fa-plus-circle").addClass("fa-minus-circle");
            }else{
                tr.find(".dt-control > i.fa-minus-circle").removeClass("fa-minus-circle").addClass("fa-plus-circle");
            }
        
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
            }
            else {
                // Open this row
                row.child(format(row.data())).show();
            }
        });

        $('input.global_filter').on('keyup click', function () {
            filterGlobal(table);
        });
        
        $('input.column_filter').on('keyup click', function () {
            filterColumn(table, $(this).attr('data-column'));
        });

        $(".DokumRekom").click(function() {
            $value = $(this).data('val');
            $('#global_filter').val($value);
            filterGlobal(table);
        });

        })
        .fail(function(status) {
        console.log( status );
        });
    }


});



