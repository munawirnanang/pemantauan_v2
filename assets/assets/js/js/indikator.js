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
                console.log(response.data)
                $('#grafik-b1').empty();
                var htmlChart

                const transformedData = response.data.reduce((result, item) => {
                    let indikator = result.find(r => r.name === item.nama_indikator);
                    if (!indikator) {
                        indikator = { name: item.nama_indikator, id: item.id_indikator, series: [] };
                        result.push(indikator);
                    }
                    let region = indikator.series.find(r => r.name === item.nama_wilayah);
                    if (!region) {
                        region = { name: item.nama_wilayah, data: [] };
                        indikator.series.push(region);
                    }
                    region.data.push(parseFloat(item.nilai));
                    return result;
                }, []);

                for(i=0;i<transformedData.length;i++){
                    chartId = transformedData[i].name.replace(/\s+/g, '-');
                    htmlChart = '<div class="col-lg-6">';
                    htmlChart += '<div class="panel panel-default panel-border" style="border-radius: 30px; border: 1px solid #ccc;">';
                    htmlChart += '<div class="panel-body">';
                    htmlChart += '<div id='+chartId+'>';
                    htmlChart += '</div>';
                    htmlChart += '</div>';
                    htmlChart += '</div>';
                    htmlChart += '</div>';
                    console.log(chartId)
                    
                    $('#grafik-b1').append(htmlChart);
                    Highcharts.chart(chartId, {
                        chart: {
                            type: 'line'
                        },
                        title: {
                            text: transformedData[i].name
                        },
                        xAxis: {
                            categories: response.categories
                        },
                        plotOptions: {
                            line: {
                                dataLabels: {
                                    enabled: true
                                },
                                enableMouseTracking: false
                            },
                            series: {
                                connectNulls: true
                            }
                        },
                        series: transformedData[i].series
                    });

                    htmlChart ='';
                }

                $('#tabel_indikator').html(response.html_tabel);

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
