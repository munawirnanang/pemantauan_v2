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
                const activeIndikator = Object.values(response.unique_indikator);
                
                const activeIdIndikator = formData.indikator.sort();
                var inputIndikator = ["#indikator1", "#indikator2", "#indikator3", "#indikator4"];
                
                if (activeIndikator.length === 1) {
                    $('#alloption').hide();
                    $('#divider').hide();
                } else {
                    $('#alloption').show();
                    $('#divider').show();
                    for (var i = 0; i < inputIndikator.length; i++) {
                        if (i < activeIndikator.length) {
                            $(inputIndikator[i]).text(activeIndikator[i]).show();
                            $(inputIndikator[i]).val(activeIdIndikator[i]);
                        } else {
                            $(inputIndikator[i]).hide();
                        }
                    }
                }
                
                const firstIdIndikator = activeIdIndikator[0]
                const dataArray = Object.values(response.data);

                const uniqueNumbers = new Set(
                    Object.keys(response.nilai_data)
                        .filter(key => key.startsWith('properties_'))
                        .map(key => key.match(/properties_(\d+)_\d+/)[1])
                );
                const selectedIndikator = Array.from(uniqueNumbers);
                
                const years = Object.keys(response.nilai_data).filter(key => key.startsWith('properties_'+firstIdIndikator+'_')).map(key => key.split('_').pop());
                const minYear = Math.min(...years);
                const maxYear = Math.max(...years);
                
                const defaultIndikator = Math.min(...selectedIndikator);

                const slider = document.getElementById('slider');
                

                slider.min = minYear;
                slider.max = maxYear;
                slider.value = minYear;

                
                $('#selecttahun').text(minYear)
                const geojsonData = {};

                selectedIndikator.forEach(i => {
                    geojsonData[i] = {};  // Initialize sub-object for each unique number
                    years.forEach(year => {
                        const propertyKey = `properties_${i}_${year}`;
                        if (response.nilai_data.hasOwnProperty(propertyKey)) {
                            geojsonData[i][year] = {
                                type: 'FeatureCollection',
                                features: response.nilai_data[propertyKey].map(f => f)
                            };
                        } else {
                            geojsonData[i][year] = {
                                type: 'FeatureCollection',
                                features: []
                            };
                        }
                    });
                });

                $('#judul_indikator').text(response.data[0].nama_indikator)
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

                let peta = geojsonData[defaultIndikator][minYear].features[0];
                console.log(peta);
                
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

                $('#satuan').text('Satuan : '+peta.properties.satuan);
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
                        'data': geojsonData[defaultIndikator][minYear]
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


                    if (activeIndikator.length === 1) {
                        slider.addEventListener('input', (e) => {
                            const year = e.target.value;

                            console.log(geojsonData[defaultIndikator][year].features[0]);
                            const newPeta = geojsonData[defaultIndikator][year].features[0];
                            const newColorSettings = setColorSettings(newPeta.properties);

                            map.getSource('maine').setData(geojsonData[defaultIndikator][year]);
                            
                            $('#selecttahun').text(year);
                            if(newPeta.properties.jenis === 'positif'){
                                $('#keterangan1').text('<  Nasional Capaian Nasional : '+newPeta.properties.nasional);
                                $('#keterangan2').text('>= Nasional Capaian Nasional : '+newPeta.properties.nasional);
                            }else{
                                $('#keterangan1').text('>= Nasional Capaian Nasional : '+newPeta.properties.nasional);
                                $('#keterangan2').text('<  Nasional Capaian Nasional : '+newPeta.properties.nasional);
                            }
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
                    }else{

                        $('button[name="indktr"]').click(function() {
                            var btnIndktr = $(this).val();
                            var namaIndktr = $(this).text();
                            console.log('Button clicked:', namaIndktr);
                            
                            $('#judul_indikator').text(namaIndktr)
                            if (btnIndktr !== '-') {
                                $('button[name="indktr"]').removeClass("btn-primary").addClass("btn-default");
                                $(this).removeClass("btn-default").addClass("btn-primary");
                            }
                        
                            const updateMapData = (year) => {
                        
                                if (!geojsonData[btnIndktr] || !geojsonData[btnIndktr][year]) {
                                    console.error('Data not found for:', btnIndktr, year);
                                    return;
                                }
                        
                                console.log(geojsonData[btnIndktr][year].features[0]);
                                const newPeta = geojsonData[btnIndktr][year].features[0];
                                const newColorSettings = setColorSettings(newPeta.properties);
                        
                                map.getSource('maine').setData(geojsonData[btnIndktr][year]);
                        
                                $('#satuan').text('Satuan : '+newPeta.properties.satuan);
                                $('#selecttahun').text(year);
                                if (newPeta.properties.jenis === 'positif') {
                                    $('#keterangan1').html('<  Nasional Capaian Nasional : ' + newPeta.properties.nasional);
                                    $('#keterangan2').html('>= Nasional Capaian Nasional : ' + newPeta.properties.nasional);
                                } else {
                                    $('#keterangan1').html('>= Nasional Capaian Nasional : ' + newPeta.properties.nasional);
                                    $('#keterangan2').html('<  Nasional Capaian Nasional : ' + newPeta.properties.nasional);
                                }
                        
                                map.setPaintProperty('states-layer', 'fill-color', [
                                    'interpolate',
                                    ['linear'],
                                    ['get', 'nilai'],
                                    newPeta.properties.nasional - 0.0001,
                                    newColorSettings.warna1,
                                    newPeta.properties.nasional,
                                    newColorSettings.warna2,
                                ]);
                            };
                        
                            const currentYear = slider.value;
                            updateMapData(currentYear);
                        
                            // Add event listener to the slider
                            slider.addEventListener('input', (e) => {
                                const year = e.target.value;
                                updateMapData(year);
                            });
                        });    
                    }
                    
                    // slider.addEventListener('input', (e) => {
                    //     const year = e.target.value;

                    //     console.log(geojsonData[defaultIndikator][year].features[0]);
                    //     const newPeta = geojsonData[defaultIndikator][year].features[0];
                    //     const newColorSettings = setColorSettings(newPeta.properties);

                    //     map.getSource('maine').setData(geojsonData[defaultIndikator][year]);
                        
                    //     $('#selecttahun').text(year);
                    //     if(newPeta.properties.jenis === 'positif'){
                    //         $('#keterangan1').text('<  Nasional Capaian Nasional : '+newPeta.properties.nasional);
                    //         $('#keterangan2').text('>= Nasional Capaian Nasional : '+newPeta.properties.nasional);
                    //     }else{
                    //         $('#keterangan1').text('>= Nasional Capaian Nasional : '+newPeta.properties.nasional);
                    //         $('#keterangan2').text('<  Nasional Capaian Nasional : '+newPeta.properties.nasional);
                    //     }

                    //     map.setPaintProperty('states-layer', 'fill-color', [
                    //         'interpolate',
                    //         ['linear'],
                    //         ['get', 'nilai'],
                    //         newPeta.properties.nasional - 0.0001,
                    //         newColorSettings.warna1,
                    //         newPeta.properties.nasional,
                    //         newColorSettings.warna2,
                    //     ]);
                    // });

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

                    map.on('mouseleave', 'states-layer', () => {
                        if (hoveredStateId !== null) {
                            map.setFeatureState({
                                source: 'maine',
                                id: hoveredStateId
                            }, {
                                hover: false
                            });
                        }
                        hoveredStateId = null;
                    });

                    map.on('mouseenter', 'states-layer', (e) => {
                        popup.setLngLat(e.lngLat).setHTML(e.features[0].properties.short_description).addTo(map)
                    });

                    map.on('mouseleave', 'states-layer', (e) => {
                        map.getCanvas().style.cursor = '';
                        popup.remove();
                    });

                    map.on('click', 'states-layer', (e) => {
                        document.getElementById('description').innerHTML = '<p style="margin-bottom: 2px;">' + e.features[0].properties.description + '</p>';
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
