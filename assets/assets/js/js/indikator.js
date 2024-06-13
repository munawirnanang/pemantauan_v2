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
                const activeIdIndikator = formData.indikator.sort();
                const dataArray = Object.values(response.data);
                
                const years = Object.keys(response.nilai_data).filter(key => key.startsWith('properties_'+activeIdIndikator+'_')).map(key => key.split('_').pop());
                const minYear = Math.min(...years);
                const maxYear = Math.max(...years);

                const slider = document.getElementById('slider');

                slider.min = minYear;
                slider.max = maxYear;
                slider.value = minYear;

                
                $('#selecttahun').text(minYear)
                const geojsonData = {};
                years.forEach(year => {
                    geojsonData[year] = {
                        type: 'FeatureCollection',
                        features: response.nilai_data[`properties_`+activeIdIndikator+`_${year}`].map(f => (
                            f
                
                        ))
                    };
                });
                console.log(geojsonData)
                
                $('#judul_indikator').text(response.data[0].nama_indikator)
                // console.log(peta);
                // console.log(peta.properties);


                
                
                // const activeIndikator = Object.values(response.unique_indikator);
                // const activeIdIndikator = formData.indikator.sort();
                // const activeTahun = formData.tahun.sort();
                // var tahunButtons = ["#tahun_indikator1", "#tahun_indikator2", "#tahun_indikator3", "#tahun_indikator4"];
                // for (var i = 0; i < tahunButtons.length; i++) {
                //     if (i < activeTahun.length) {
                //         $(tahunButtons[i]).text(activeTahun[i]).prop('disabled', false);
                //     } else {
                //         $(tahunButtons[i]).text('-').prop('disabled', true);
                //     }
                // }
                // console.log(response.data[0].nama_indikator);
                // $('#judul_indikator').text(response.data[0].nama_indikator)
               
                // let peta = {
                //     "type": "FeatureCollection",
                //     "features": response.nilai_data["properties_"+activeIdIndikator[0]+"_"+activeTahun[0]]
                // };
                

                // $(".btn-block").click(function() {
                //     var btnTahun = $(this).text();
                //     if (btnTahun !== '-') {
                //         $(".btn-block").removeClass("btn-primary").addClass("btn-default");
                //         $(this).removeClass("btn-default").addClass("btn-primary");
                //         let peta = {
                //             "type": "FeatureCollection",
                //             "features": response.nilai_data["properties_"+activeIdIndikator[0]+"_" + btnTahun]
                //         };
                //         console.log(response.nilai_data["properties_"+activeIdIndikator[0]+"_" + btnTahun]);
                //         if (map.getSource('maine')) {
                //             map.getSource('maine').setData(peta);
                //         };
                //     }
                // });    
                $('#grafik-b1').empty();
                var htmlChart

                const transformedData = dataArray.reduce((result, item) => {
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
                    center: [118.206479, -1.990152], // starting position [lng, lat]
                    zoom: 3.5 // starting zoom
                });

                let peta = geojsonData[minYear].features[0];
                
                const setColorSettings = (properties) => {
                    if (properties.jenis === 'positif') {
                        return {
                            warna1: '#ff8989', // merah
                            warna2: '#a9ff68'  // hijau
                    };
                    } else if (properties.jenis === 'negatif') {
                        return {
                            warna1: '#a9ff68', // hijau
                            warna2: '#ff8989'  // merah
                        };
                    }
                };

                console.log(peta.properties.satuan);
                $('#satuan').text('satuan :'+peta.properties.satuan);
                if(peta.properties.jenis === 'positif'){
                    $('#keterangan1').text('<  Nasional Capaian Nasional : '+peta.properties.nasional);
                    $('#keterangan2').text('>= Nasional Capaian Nasional : '+peta.properties.nasional);
                }else{
                    $('#keterangan1').text('>= Nasional Capaian Nasional : '+peta.properties.nasional);
                    $('#keterangan2').text('<  Nasional Capaian Nasional : '+peta.properties.nasional);
                }
            
                const colorSettings = setColorSettings(peta.properties);
                
                map.addControl(new mapboxgl.FullscreenControl());
                map.addControl(new mapboxgl.NavigationControl());

                map.on('load', () => {
                    // Add a data source containing GeoJSON data.
                    map.addSource('maine', {
                        'type': 'geojson',
                        'data': geojsonData[minYear]
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
                                peta.properties.nasional - 0.0001,
                                colorSettings.warna1,
                                peta.properties.nasional,
                                colorSettings.warna2,
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


                    slider.addEventListener('input', (e) => {
                        const year = e.target.value;

                        console.log(geojsonData[year].features[0]);
                        const newPeta = geojsonData[year].features[0];
                        const newColorSettings = setColorSettings(newPeta.properties);

                        map.getSource('maine').setData(geojsonData[year]);
                        
                        $('#selecttahun').text(year)

                        map.setPaintProperty('states-layer', 'fill-color', [
                            'interpolate',
                            ['linear'],
                            ['get', 'nilai'],
                            newPeta.properties.nasional - 0.0001,
                            newColorSettings.warna1,
                            newPeta.properties.nasional,
                            newColorSettings.warna2,
                        ]);
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
