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
                console.log(response)
                const peta = response.geometry.peta;
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

                htmlmap = '';
                htmlmap +="<div class='map-overlay' id='features'><div><p id='pd'><i>sorot kursor pada daerah</i></p></div></div>";
                
                $('#map').append(htmlmap);

                //peta
                let hoveredStateId = null;
                mapboxgl.accessToken = 'pk.eyJ1IjoiZnJhbnNhbGFtb25kYSIsImEiOiJja2NlZ2xtMjkwMzgxMzJubm9paGJ5dmMyIn0.QJc2VJF6md9CaTilCmgYag';
                const map = new mapboxgl.Map({
                    container: 'map', // container ID
                    style: 'mapbox://styles/mapbox/light-v10',
                    center: [118.206479, -1.920152], // starting position [lng, lat]
                    zoom: 4 // starting zoom
                });

                if (peta.features[0].properties.jenis == 'positif') {
                    var warna1 = '#ff8989'; //merah
                    var warna2 = '#a9ff68'; //hijau
                } else if (peta.features[0].properties.jenis == 'negatif') {
                    var warna2 = '#ff8989'; //merah
                    var warna1 = '#a9ff68'; //hijau
                }
                
                map.addControl(new mapboxgl.FullscreenControl());
                map.addControl(new mapboxgl.NavigationControl());

                map.on('load', () => {
                    // Add a data source containing GeoJSON data.
                    map.addSource('maine', {
                        'type': 'geojson',
                        'data': peta
                    });



                    // Add a new layer to visualize the polygon.
                    map.addLayer({
                        'id': 'states-layer',
                        'type': 'fill',
                        'source': 'maine', // reference the data source
                        'layout': {},
                        'paint': {
                            'fill-color': [
                                'interpolate',
                                ['linear'],
                                ['get', 'nilai'],
                                peta.features[0].properties.nasional - 0.0001,
                                warna1,
                                peta.features[0].properties.nasional,
                                warna2,
                            ], 
                            'fill-opacity': [
                                'case',
                                ['boolean', ['feature-state', 'hover'], false],
                                1,
                                0.5
                            ],
                        }
                    });
                    // Add a black outline around the polygon.
                    map.addLayer({
                        'id': 'outline',
                        'type': 'line',
                        'source': 'maine',
                        'layout': {},
                        'paint': {
                            'line-color': '#000',
                            'line-width': [
                                'case',
                                ['boolean', ['feature-state', 'click'], false],
                                2,
                                0.5
                            ]
                        }
                    });

                    const popup = new mapboxgl.Popup({
                        closeButton: false,
                        closeOnClick: false
                    });

                    map.on('mousemove', 'states-layer', (e) => {
                        if (e.features.length > 0) {
                            if (hoveredStateId !== null) {
                                map.setFeatureState({
                                    source: 'maine',
                                    id: hoveredStateId
                                }, {
                                    hover: false
                                });
                            }
                            hoveredStateId = e.features[0].id;
                            map.setFeatureState({
                                source: 'maine',
                                id: hoveredStateId
                            }, {
                                hover: true
                            });
                        }
                    });
                    
                });

                function resizeMap() {
                    map.resize();
                }
                
                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                        if ($(e.target).attr('href') === '#maps-b1') {
                            resizeMap();
                        }
                    });

                $(document).ready(function() {
                    if ($('#maps-b1').hasClass('active')) {
                        resizeMap();
                    }
                });

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
