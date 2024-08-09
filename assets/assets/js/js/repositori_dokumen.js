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
            // console.log(json[0].jenis);
            console.log(json);

            Highcharts.chart('container', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Persentase jumlah dokumen berdasarkan jenis'
                },
                tooltip: {
                    valueSuffix: '',
                    pointFormat: '{series.name}: {point.y} <b>({point.percentage:.1f}%)</b>'
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
                            distance: 20
                        }, {
                            enabled: true,
                            distance: -40,
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
                        name: 'Persentase',
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

// $(document).ready(function() {
//     var link2 = base_url + "/count_doc_by_wilayah";
//     $.ajax({
//         url: link2,  
//         type: 'GET',  
//         success: function(response) { 
//             console.log(response);
//         },
//         error: function(err) { 
//             console.log(err);
//         }
//     });
// });


$(document).ready(function() {

    // Create the chart
    Highcharts.chart('container-2', {
        chart: {
            type: 'column'
        },
        title: {
            align: 'left',
            text: 'Jumlah dokumen berdasarkan wilayah'
        },
        subtitle: {
            align: 'left',
            text: 'Sumber dokumen aplikasi Penghargaan Pembangunan Daerah. Source: <a href="https://peppd.bappenas.go.id/jumper_ppd/" target="_blank">Penghargaan Pembangunan Daerah</a>'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Total percent market share'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: ' +
                '<b>{point.y:.2f}%</b> of total<br/>'
        },

        series: [
            {
                name: 'Browsers',
                colorByPoint: true,
                data: [
                    {
                        name: 'Chrome',
                        y: 63.06,
                        drilldown: 'Chrome'
                    },
                    {
                        name: 'Safari',
                        y: 19.84,
                        drilldown: 'Safari'
                    },
                    {
                        name: 'Firefox',
                        y: 4.18,
                        drilldown: 'Firefox'
                    },
                    {
                        name: 'Edge',
                        y: 4.12,
                        drilldown: 'Edge'
                    },
                    {
                        name: 'Opera',
                        y: 2.33,
                        drilldown: 'Opera'
                    },
                    {
                        name: 'Internet Explorer',
                        y: 0.45,
                        drilldown: 'Internet Explorer'
                    },
                    {
                        name: 'Chrome-2',
                        y: 63.06,
                        drilldown: 'Chrome-2'
                    },
                    {
                        name: 'Safari-2',
                        y: 19.84,
                        drilldown: 'Safari-2'
                    },
                    {
                        name: 'Firefox-2',
                        y: 4.18,
                        drilldown: 'Firefox-2'
                    },
                    {
                        name: 'Edge-2',
                        y: 4.12,
                        drilldown: 'Edge-2'
                    },
                    {
                        name: 'Opera-2',
                        y: 2.33,
                        drilldown: 'Opera-2'
                    },
                    {
                        name: 'Internet Explorer-2',
                        y: 0.45,
                        drilldown: 'Internet Explorer-2'
                    },
                    {
                        name: 'Chrome-3',
                        y: 63.06,
                        drilldown: 'Chrome-3'
                    },
                    {
                        name: 'Safari-3',
                        y: 19.84,
                        drilldown: 'Safari-3'
                    },
                    {
                        name: 'Firefox-3',
                        y: 4.18,
                        drilldown: 'Firefox-3'
                    },
                    {
                        name: 'Edge-3',
                        y: 4.12,
                        drilldown: 'Edge-3'
                    },
                    {
                        name: 'Opera-3',
                        y: 2.33,
                        drilldown: 'Opera-3'
                    },
                    {
                        name: 'Internet Explorer-3',
                        y: 0.45,
                        drilldown: 'Internet Explorer-3'
                    },
                    {
                        name: 'Chrome-4',
                        y: 63.06,
                        drilldown: 'Chrome-4'
                    },
                    {
                        name: 'Safari-4',
                        y: 19.84,
                        drilldown: 'Safari-4'
                    },
                    {
                        name: 'Firefox-4',
                        y: 4.18,
                        drilldown: 'Firefox-4'
                    },
                    {
                        name: 'Edge-4',
                        y: 4.12,
                        drilldown: 'Edge-4'
                    },
                    {
                        name: 'Opera-4',
                        y: 2.33,
                        drilldown: 'Opera-4'
                    },
                    {
                        name: 'Internet Explorer-4',
                        y: 0.45,
                        drilldown: 'Internet Explorer-4'
                    },
                    {
                        name: 'Chrome-5',
                        y: 63.06,
                        drilldown: 'Chrome-5'
                    },
                    {
                        name: 'Safari-5',
                        y: 19.84,
                        drilldown: 'Safari-5'
                    },
                    {
                        name: 'Firefox-5',
                        y: 4.18,
                        drilldown: 'Firefox-5'
                    },
                    {
                        name: 'Edge-5',
                        y: 4.12,
                        drilldown: 'Edge-5'
                    },
                    {
                        name: 'Opera-5',
                        y: 2.33,
                        drilldown: 'Opera-5'
                    },
                    {
                        name: 'Internet Explorer-5',
                        y: 0.45,
                        drilldown: 'Internet Explorer-5'
                    },
                    {
                        name: 'Chrome-6',
                        y: 63.06,
                        drilldown: 'Chrome-6'
                    },
                    {
                        name: 'Safari-6',
                        y: 19.84,
                        drilldown: 'Safari-6'
                    },
                    {
                        name: 'Firefox-6',
                        y: 4.18,
                        drilldown: 'Firefox-6'
                    },
                    {
                        name: 'Edge-6',
                        y: 4.12,
                        drilldown: 'Edge-6'
                    },
                    {
                        name: 'Opera-6',
                        y: 2.33,
                        drilldown: 'Opera-6'
                    },
                    {
                        name: 'Internet Explorer-6',
                        y: 0.45,
                        drilldown: 'Internet Explorer-6'
                    },
                    {
                        name: 'Other',
                        y: 1.582,
                        drilldown: null
                    }
                ]
            }
        ],
        drilldown: {
            breadcrumbs: {
                position: {
                    align: 'right'
                }
            },
            series: [
                {
                    name: 'Chrome',
                    id: 'Chrome',
                    data: [
                        [
                            'v65.0',
                            0.1
                        ],
                        [
                            'v64.0',
                            1.3
                        ],
                        [
                            'v63.0',
                            53.02
                        ],
                        [
                            'v62.0',
                            1.4
                        ],
                        [
                            'v61.0',
                            0.88
                        ],
                        [
                            'v60.0',
                            0.56
                        ],
                        [
                            'v59.0',
                            0.45
                        ],
                        [
                            'v58.0',
                            0.49
                        ],
                        [
                            'v57.0',
                            0.32
                        ],
                        [
                            'v56.0',
                            0.29
                        ],
                        [
                            'v55.0',
                            0.79
                        ],
                        [
                            'v54.0',
                            0.18
                        ],
                        [
                            'v51.0',
                            0.13
                        ],
                        [
                            'v49.0',
                            2.16
                        ],
                        [
                            'v48.0',
                            0.13
                        ],
                        [
                            'v47.0',
                            0.11
                        ],
                        [
                            'v43.0',
                            0.17
                        ],
                        [
                            'v29.0',
                            0.26
                        ]
                    ]
                },
                {
                    name: 'Firefox',
                    id: 'Firefox',
                    data: [
                        [
                            'v58.0',
                            1.02
                        ],
                        [
                            'v57.0',
                            7.36
                        ],
                        [
                            'v56.0',
                            0.35
                        ],
                        [
                            'v55.0',
                            0.11
                        ],
                        [
                            'v54.0',
                            0.1
                        ],
                        [
                            'v52.0',
                            0.95
                        ],
                        [
                            'v51.0',
                            0.15
                        ],
                        [
                            'v50.0',
                            0.1
                        ],
                        [
                            'v48.0',
                            0.31
                        ],
                        [
                            'v47.0',
                            0.12
                        ]
                    ]
                },
                {
                    name: 'Internet Explorer',
                    id: 'Internet Explorer',
                    data: [
                        [
                            'v11.0',
                            6.2
                        ],
                        [
                            'v10.0',
                            0.29
                        ],
                        [
                            'v9.0',
                            0.27
                        ],
                        [
                            'v8.0',
                            0.47
                        ]
                    ]
                },
                {
                    name: 'Safari',
                    id: 'Safari',
                    data: [
                        [
                            'v11.0',
                            3.39
                        ],
                        [
                            'v10.1',
                            0.96
                        ],
                        [
                            'v10.0',
                            0.36
                        ],
                        [
                            'v9.1',
                            0.54
                        ],
                        [
                            'v9.0',
                            0.13
                        ],
                        [
                            'v5.1',
                            0.2
                        ]
                    ]
                },
                {
                    name: 'Edge',
                    id: 'Edge',
                    data: [
                        [
                            'v16',
                            2.6
                        ],
                        [
                            'v15',
                            0.92
                        ],
                        [
                            'v14',
                            0.4
                        ],
                        [
                            'v13',
                            0.1
                        ]
                    ]
                },
                {
                    name: 'Opera',
                    id: 'Opera',
                    data: [
                        [
                            'v50.0',
                            0.96
                        ],
                        [
                            'v49.0',
                            0.82
                        ],
                        [
                            'v12.1',
                            0.14
                        ]
                    ]
                }
            ]
        }
    });

});




