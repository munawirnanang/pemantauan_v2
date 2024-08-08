$(document).ready(function() {

  getDoc();

  function getDoc() {
    var link = base_url+"/show_doc"; //base_url from universal.js;
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

      var dataSet1 = [
          {
            'id': '1',
            'Nama Dokumen': 'Inovasi Pembangunan Daerah Kabupaten Ogan Komering Ilir',
            'Jenis': 'Inovasi',
            'Tahun': '2022',
            'Diupload Oleh': 'Kabupaten Ogan Komering Ilir',
            'Alias': '-',
            'File': 'PDF',
            'Deskripsi': 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English.',
            'Aksi': '<button type="button" class="btn btn-xs btn-info btn-bordered waves-effect waves-light m-b-5">Unduh Langsung</button> <button type="button" class="btn btn-xs btn-inverse btn-bordered waves-effect waves-light m-b-5">Tambah Ke Folder</button>',
          },
          {
            'id': '2',
            'Nama Dokumen': 'Inovasi Pembangunan Daerah Kabupaten Ogan Komering Ulu',
            'Jenis': 'Inovasi',
            'Tahun': '2021',
            'Diupload Oleh': 'Kabupaten Ogan Komering Ulu',
            'Alias': '-',
            'File': 'DOCX',
            'Deskripsi': 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English.',
            'Aksi': '<button type="button" class="btn btn-xs btn-info btn-bordered waves-effect waves-light m-b-5">Unduh Langsung</button> <button type="button" class="btn btn-xs btn-inverse btn-bordered waves-effect waves-light m-b-5">Tambah Ke Folder</button>',
          }
        ];  

      // Formatting function for row details - modify as you need
      function format(d) {
          // `d` is the original data object for the row
          return (
              '<dl>' +
                  '<div class="row" style="display: flex;">' +
                      '<div class="col-4" style="width: 20%;">' +
                          '<dt style="margin-left: 30px;">' +
                              'Alias' +
                          '</dt>' +
                      '</div>' +
                      '<div class="col-8" style="width: 80%;">' +
                          '<dd>' +
                              d.Alias +
                          '</dd>' +
                      '</div>' +
                  '</div>' +
                  '<div class="row" style="display: flex;">' +
                      '<div class="col-4" style="width: 20%;">' +
                          '<dt style="margin-left: 30px;">' +
                              'File' +
                          '</dt>' +
                      '</div>'+
                      '<div class="col-8" style="width: 80%;">' +
                          '<dd>' +
                              d.File +
                          '</dd>' +
                      '</div>' +
                  '</div>' +
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
                              'Dokumen Terkait' +
                          '</dt>' +
                      '</div>' +
                      '<div class="col-8" style="width: 80%;">' +
                          '<dd>' +
                              '-' +
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
              { data: 'Jenis' },
              { data: 'Tahun' },
              { data: 'Diupload Oleh' },
              { data: 'Aksi' }
          ],
          columnDefs: [
            { width: '0.1%', targets: 0 },
            { width: '49.9%', targets: 1 },
            { width: '13%', targets: 2 },
            { width: '7%', targets: 3 },
            { width: '15%', targets: 4 },
            { width: '15%', targets: 5 }
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

    // $('.addToFolder').click(function() {
    //     alert('Sukses');
    // });

    // $(".addToFolder").on('click', function() {
    //     var id = $(this).data('id');
    //     alert(id);
    // });

    // Use event delegation to handle dynamically created buttons
    // $(document).on('click', '.addToFolder', function() {
    //     var id = $(this).data('id');
    //     addToFolder(id);
    // });

    // function addToFolder(id) {
    //     alert("Document ID to add:");
    //     // Your logic to add the document to the folder goes here
    // }
});

$(document).ready(function() {
    var link = base_url + "/count_doc_by_jenis"; // Base_url dari universal.js atau dari mana pun Anda mendapatkannya
    $.ajax({  
        url: link,  
        type: 'GET',  
        success: function(response) {  
            var json = JSON.parse(response); // Tidak perlu parseJSON karena response sudah dalam format JSON
            console.log(json[0].jenis);
            console.log(typeof(json));

            Highcharts.chart('container', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Persentase jumlah dokumen berdasarkan jenis'
                },
                tooltip: {
                    valueSuffix: ''
                },
                subtitle: {
                    text:
                    'Source:Dokumen PEPPD'
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: [{
                            enabled: true,
                            distance: 10
                        }, {
                            enabled: true,
                            distance: -20,
                            format: '{point.percentage:.1f}%',
                            style: {
                                fontSize: '1.2em',
                                textOutline: 'none',
                                opacity: 0.7
                            },
                            filter: {
                                operator: '>',
                                property: 'percentage',
                                value: 10
                            }
                        }]
                    }
                },
                series: [
                    {
                        name: 'Jumlah',
                        colorByPoint: true,
                        data: json
                    }
                ]
            });

        },
        error: function(err) { 
            console.log(err);
        }
    });

});



