$(document).ready(function() {
    //overview
    $.ajax({
        url: base_url+'overview',
        type: 'POST',
        success: function(response) {
            // console.log(response.data);
            let dataWilayah = {};
            let distinctNamaWilayah = [];

            response.data.forEach(item => {
                const namaWilayah = item.nama_wilayah; 

                if (!distinctNamaWilayah.includes(namaWilayah)) {
                    distinctNamaWilayah.push(namaWilayah);
                }

                if (!dataWilayah[namaWilayah]) {
                    dataWilayah[namaWilayah] = [];
                }

                dataWilayah[namaWilayah].push(item);
            });
            
            var html_overview =''

            // var html_overview = '<h3>Prvonsi, Kota, dan Kabupaten dengan PAD terbesar</h3>'
            for(let i = 0; i < distinctNamaWilayah.length; i++)
            {
                html_overview +='<div class="col-lg-4 col-md-4">'
                html_overview +='<div class="card-box widget-box-three">'
                html_overview +='<div class="bg-icon pull-left">'
				html_overview +='<i class="ti-shopping-cart"></i>'
				html_overview +='</div>'
                html_overview +='<div class="text-right">'
                html_overview +='<p class="text-success m-t-5 text-uppercase font-600 font-secondary">'+dataWilayah[distinctNamaWilayah[i]][0].nama_wilayah+'</p>'
                html_overview +='<h2 class="m-b-10"><span data-plugin="counterup">'+parseFloat(dataWilayah[distinctNamaWilayah[i]][0].jumlah).toLocaleString('en-US', { maximumFractionDigits: 2 })+'</span></h2>'
                html_overview +='</div>'
                html_overview +='</div>'
                html_overview +='</div>'
            }
            //card
            $('#apbd-overview').append(html_overview);
            html_overview =''; 

            //tree
            for(let u = 0; u < distinctNamaWilayah.length; u++)
                {
                dataChart =dataWilayah[distinctNamaWilayah[u]];
                const color = ['#292F36','#4ECDC4','#A3E6DE','#F7FFF7','#FBB5B1','#FF6B6B','#FFA96C','#FFC86D','#FFE66D'];
                
                // const usedColors = new Set();

                // function getRandomUniqueColor() {
                //     let randomColor;
                //     do {
                //         randomColor = color[Math.floor(Math.random() * color.length)];
                //     } while (usedColors.has(randomColor));  
                //     usedColors.add(randomColor);
                //     return randomColor;
                // }

                function getColorForKodeItem(kodeItem) {
                    const colorMapping = {
                        '4': '#FBB5B1',
                        '5': '#4ECDC4',
                        '6': '#FFA96C'
                    };
                    return colorMapping[kodeItem] || '#CCCCCC';
                }

                const transformedData = [...dataChart.map(item => {
                    let parentCode;
                    let itemColor;
                    
                    
                    if (item.kode_item.length === 1) {
                        parentCode = "0";
                        itemColor = getColorForKodeItem(item.kode_item);
                        return {
                            id: item.kode_item,
                            parent: parentCode,
                            name : item.nama_item,
                            value: +item.jumlah,
                            color: itemColor || undefined
                        };
                        
                    } else if(item.kode_item.length === 2) {
                        parentCode = item.kode_item.slice(0, -1);
                        return {
                            id: item.kode_item,
                            parent: parentCode,
                            name : item.nama_item,
                            value: +item.jumlah
                        };
                    } else {
                        parentCode = item.kode_item.slice(0, -2);
                        return {
                            id: item.kode_item,
                            parent: parentCode,
                            name : item.nama_item,
                            value: +item.jumlah
                        };
                    }
                })];
                console.log(transformedData);
                
                var chartId = "tree_map"+distinctNamaWilayah[u]; 
                html_overview =''; 
                html_overview += '<div class="col-lg-12">';
                html_overview += '<div class="panel panel-default panel-border" style="border: 1px solid #ccc;">';
                html_overview += '<div class="panel-body">';
                html_overview += '<div id="' + chartId + '">';
                html_overview += '</div>';
                html_overview += '</div>';
                html_overview += '</div>';
                html_overview += '</div>';
                $('#apbd-overview').append(html_overview);
                Highcharts.chart(chartId, {
                    chart: {
                        type: 'treemap'
                    },
                    title: {
                        text: 'APBD '+distinctNamaWilayah[u]+' Pendapatan, Belanja, dan Pembiayaan Daerah'  
                    },
                    series: [{
                        data: transformedData
                    }],
                    tooltip: {
                        pointFormat: '{point.name}: <b>{point.value}</b>'
                    }
                });
                
            }

            // //sankey
            // for(let u = 0; u < distinctNamaWilayah.length; u++)
            //     {
            //         dataChart =dataWilayah[distinctNamaWilayah[i]];
            //         const color = ['#292F36','#4ECDC4','#A3E6DE','#F7FFF7','#FBB5B1','#FF6B6B','#FFA96C','#FFC86D','#FFE66D'];
    
            //         function shuffle(array) {
            //             for (let i = array.length - 1; i > 0; i--) {
            //                 const j = Math.floor(Math.random() * (i + 1));
            //                 [array[i], array[j]] = [array[j], array[i]];
            //             }
            //             return array;
            //         }
    
            //         const shuffledColors = shuffle([...color]);
    
            //         const nodes = dataChart.map((item, index) => {
            //             const color = shuffledColors[index % shuffledColors.length];
                        
            //             if (item.kode_item.length === 1) {
            //                 return {
            //                     id: item.nama_item,
            //                     color: color
            //                 };
            //             } else if (item.kode_item.length === 2) {
            //                 return {
            //                     id: item.nama_item,
            //                     color: color
            //                 };
            //             } else {
            //                 return {
            //                     id: item.nama_item,
            //                     color: color
            //                 };
            //             }
            //         });
    
            //         console.log(dataChart);
            //         const sankeyChart = [];
            //         const groups = dataChart.reduce((acc, item) => {
            //             const key = item.kode_item.length;
            //             if (!acc[key]) acc[key] = [];
            //             acc[key].push(item);
            //             return acc;
            //         }, {});
                    
            //         groups[1]?.forEach(level1 => {
            //             groups[2]?.forEach(level2 => {
            //                 if (level2.kode_item.startsWith(level1.kode_item)) {
            //                     sankeyChart.push([level1.nama_item, level2.nama_item, Number(level2.jumlah)]);
            //                 }
            //             });
            //         });
                    
            //         groups[2]?.forEach(level2 => {
            //             groups[4]?.forEach(level3 => {
            //                 if (level3.kode_item.startsWith(level2.kode_item)) {
            //                     sankeyChart.push([level2.nama_item, level3.nama_item, Number(level3.jumlah)]);
            //                 }
            //             });
            //         });
                    
            //         var chartId = "sankey_"+distinctNamaWilayah[u]; 
            //         html_overview =''; 
            //         html_overview += '<div class="col-lg-12">';
            //         html_overview += '<div class="panel panel-default panel-border" style="border: 1px solid #ccc;">';
            //         html_overview += '<div class="panel-body">';
            //         html_overview += '<div id="' + chartId + '">';
            //         html_overview += '</div>';
            //         html_overview += '</div>';
            //         html_overview += '</div>';
            //         html_overview += '</div>';
            //         $('#apbd-overview').append(html_overview);
            //         Highcharts.chart(chartId, {
            //             title: {
            //                 text: dataChart[0].nama_item+' '+distinctNamaWilayah[u]
            //             },
            //             accessibility: {
            //                 point: {
            //                     valueDescriptionFormat: '{index}. {point.from} to {point.to}, {point.weight}.'
            //                 }
            //             },
            //             tooltip: {
            //                 headerFormat: null,
            //                 pointFormat: '{point.fromNode.name} \u2192 {point.toNode.name}: {point.weight:.2f}',
            //                 nodeFormat: '{point.name}: {point.sum:.2f}'
            //             },
            //             series: [{
            //                 keys: ['from', 'to', 'weight'],
            //                 nodes: nodes,
            //                 data: sankeyChart,
            //                 type: 'sankey',
            //                 name: 'Sankey demo series',
            //             }]
            //         });
            // }
                
        },
        error: function(xhr, status, error) {
          console.error('Error:', status, error);
        }
      });

    // form_handler.js
    $('.btn-submit').click(function(event) {
        event.preventDefault();

        // Manually submit the form
        $('#apbdform').submit();
    });
    $('#apbdform').submit(function(event) {
        event.preventDefault();

        $('#loading-animation').show();
        var formData = {
            wilayah: $('#wilayah').val(),
            item: $('#item').val(),
            tahun: $('#tahun').val()
        };
        
        $.ajax({
            url: base_url+"show_data_apbd",
            method: 'POST',
            data: formData,
            success: function(response) {
                $('#tabel-b1').html(response.tabel_html);

                //Sunburst
                let DataSunburst = {};
                let distinctTahun = [];
                let distinctNamaWilayah = [];
                response.data.forEach(item => {
                    if (!distinctTahun.includes(item.tahun)) {
                        distinctTahun.push(item.tahun);
                    }
                    if (!distinctNamaWilayah.includes(item.nama_wilayah)) {
                        distinctNamaWilayah.push(item.nama_wilayah);
                    }
                    const { tahun, nama_wilayah } = item;
                    if (!DataSunburst[tahun]) {
                        DataSunburst[tahun] = {};
                    }

                    if (!DataSunburst[tahun][nama_wilayah]) {
                        DataSunburst[tahun][nama_wilayah] = [];
                    }

                    DataSunburst[tahun][nama_wilayah].push(item);
                });

                $('#sunburst-b1').empty();                
                for (let i = 0; i < distinctTahun.length; i++) {
                    for (let o = 0; o < distinctNamaWilayah.length; o++) {

                        let dataForChart = [];
                        if (DataSunburst[distinctTahun[i]] && DataSunburst[distinctTahun[i]][distinctNamaWilayah[o]]) {
                            dataForChart = DataSunburst[distinctTahun[i]][distinctNamaWilayah[o]];
                        } else {
                            console.warn('No data found for', distinctTahun[i], distinctNamaWilayah[o]);
                        }

                        var htmlCharts = '';
                        let chartId = 'sunburst_' + distinctTahun[i] + '_' + distinctNamaWilayah[o];
                        let uniqueId = `table_sunburst_${i}_${o}`;
                        htmlCharts += '<div class="col-lg-8">';
                        htmlCharts += '<div class="panel panel-default panel-border" style="border: 1px solid #ccc;">';
                        htmlCharts += '<div class="panel-body">';
                        htmlCharts += '<div id="' + chartId + '">';
                        htmlCharts += '</div>';
                        htmlCharts += '</div>';
                        htmlCharts += '</div>';
                        htmlCharts += '</div>';
                        htmlCharts += '<div class="col-lg-4">';//table
                        htmlCharts += '<div class="panel panel-default panel-border" style="border: 1px solid #ccc;">';
                        htmlCharts += '<h4 class="m-t-5 header-title" align="center"><b>APBD '+ dataForChart[0]['nama_wilayah']+' '+dataForChart[0]['tahun']+'</b></h4>';
                        htmlCharts += `<table class="table table-striped" id="${uniqueId}">`;
                        htmlCharts += '<thead>';
                        htmlCharts += '<tr><th>Kode Item</th><th>Nama Item</th><th>Nilai</th></tr>';
                        htmlCharts += '</thead>';
                        htmlCharts += '<tbody>';
                        dataForChart.forEach(function(row) {
                            htmlCharts += '<tr>';
                            htmlCharts += '<td>' + row.kode_item + '</td>';
                            htmlCharts += '<td>' + row.nama_item + '</td>';
                            htmlCharts += '<td>' + parseFloat(row.jumlah).toLocaleString('en-US', { maximumFractionDigits: 2 }) + '</td>';
                            htmlCharts += '</tr>';
                        });
                        htmlCharts += '</tbody>';
                        htmlCharts += '</table>';
                        htmlCharts += '</div>';
                        htmlCharts += '</div>';//table
                        $('#sunburst-b1').append(htmlCharts);
                        $(`#${uniqueId}`).DataTable({
                            scrollY:        400,
                            paging:         false,
                            bInfo: false,
                            searching: false,
                            autoWidth: false
                        });

                        const root = {
                            id: "0",
                            parent: "",
                            name: "APBD"
                        };
                        const transformedData = [root, ...dataForChart.map(item => {
                            let parentCode;
                            
                            if (item.kode_item.length === 1) {
                                parentCode = "0";
                                return {
                                    id: item.kode_item,
                                    parent: parentCode,
                                    name : item.nama_item,
                                    value: +item.jumlah
                                };
                                
                            } else if(item.kode_item.length === 2) {
                                parentCode = item.kode_item.slice(0, -1);
                                return {
                                    id: item.kode_item,
                                    parent: parentCode,
                                    name : item.nama_item,
                                    value: +item.jumlah
                                };
                            } else {
                                parentCode = item.kode_item.slice(0, -2);
                                return {
                                    id: item.kode_item,
                                    parent: parentCode,
                                    name : item.nama_item,
                                    value: +item.jumlah
                                };
                            }
                        })];

                        
                        Highcharts.chart(chartId, {
                            chart: {
                                type: 'sunburst',
                                height: '460'
                            },
                            title: {
                                text: 'APBD ' + dataForChart[0]['nama_wilayah']
                            },
                            subtitle: {
                                text: 'Tahun '+dataForChart[0]['tahun']
                            },
                            series: [{
                                type: 'sunburst',
                                data: transformedData,
                                name: 'Postur',
                                allowDrillToNode: true,
                                borderRadius: 3,
                                cursor: 'pointer',
                                custom: {
                                    percentage: 'parent',  //'whole' or 'parent'
                                },
                                dataLabels: {
                                    formatter: function() {
                                        const point = this.point,
                                              series = this.series,
                                              mode = series.options.custom && series.options.custom.percentage;
                        
                                        const chartTotal = series.__myTotal || (series.__myTotal = series.data.map(p => p.options.value || 0).reduce((a, b) => a + b));
                        
                                        let percentage;
                                        switch(mode) {
                                            case 'whole':
                                                percentage = point.value/chartTotal;
                                                break;
                                            case 'parent':
                                                const group = point.parent && series.chart.get(point.parent),
                                                      total = group ? group.value : chartTotal;
                                                percentage = point.value/total;
                                                break;
                                        }
                        
                                        const val = (percentage === undefined) ? point.value : (percentage * 100).toFixed(1) + '%';
                                        return point.name + '<br>' + val;
                                    },
                                },
                                levels: [{
                                    level: 1,
                                    levelIsConstant: false,
                                    dataLabels: {
                                        enabled: false,
                                        inside: true,
                                        style: {
                                            textOverflow: 'clip',
                                            fontSize: '8px',
                                        },
                                        filter: {
                                            property: 'outerArcLength',
                                            operator: '>',
                                            value: 64
                                        }
                                    }
                                }, {
                                    level: 2,
                                    dataLabels: {
                                        style: {
                                            textOverflow: 'clip',
                                            fontSize: '8px',
                                        },
                                    },
                                    colorByPoint: true
                                },
                                {
                                    level: 3,
                                    dataLabels: {
                                        style: {
                                            textOverflow: 'clip',
                                            fontSize: '8px',
                                        },
                                    },
                                    colorVariation: {
                                        key: 'brightness',
                                        to: -0.3
                                    }
                                }, {
                                    level: 4,
                                    dataLabels: {
                                        style: {
                                            textOverflow: 'clip',
                                            fontSize: '8px',
                                        },
                                    },
                                    colorVariation: {
                                        key: 'brightness',
                                        to: 0.3
                                    }
                                }]
                            }],
                            tooltip: {
                                headerFormat: '',
                                pointFormat: '<b>{point.name}</b> sebesar <b>{point.value}</b>'
                            }
                        });
                    }
                }
                $('#table_sunburst').DataTable( {
                    scrollY:        400,
                    paging:         false,
                    bInfo: false,
                    searching: false,
                    autoWidth: false
                } );
                
                
                // //Bar
                const barData = response.data.filter(entry => entry.kode_item.length > 1);
                const parentDrilldown = response.data.filter(entry => entry.kode_item.length === 2);
                const childDrilldown = response.data.filter(entry => entry.kode_item.length === 4);

                const groupedData = {};

                parentDrilldown.forEach(item => {
                    const { kode_item } = item;

                    if (!groupedData[kode_item]) {
                        groupedData[kode_item] = [];
                    }

                    groupedData[kode_item].push(item);
                });

                const loopingParent = Object.keys(groupedData).map(kode_item => ({
                    kode_item,
                    data: groupedData[kode_item]
                }));

                $('#bar-b1').empty();
                for(let u = 0; u < loopingParent.length; u++)
                {
                    const getSeriesParent = (input) => {
                        const result = [];
                    
                        input.data.forEach(entry => {
                            const region = result.find(r => r.name === entry.nama_wilayah);
                            
                            if (region) {
                                region.data.push({
                                    name: entry.tahun,
                                    y: parseInt(entry.jumlah, 10),
                                    drilldown: `${entry.nama_wilayah}-${entry.tahun}`
                                });
                            } else {
                                result.push({
                                    name: entry.nama_wilayah,
                                    data: [{
                                        name: entry.tahun,
                                        y: parseInt(entry.jumlah, 10),
                                        drilldown: `${entry.nama_wilayah}-${entry.tahun}`
                                    }]
                                });
                            }
                        });
                        return result;
                    };
                    const seriesParent = getSeriesParent(loopingParent[u]);

                    const transformChildDrilldown = childDrilldown.map(item => {
                        if (item.kode_item.slice(0, -2) === loopingParent[u].kode_item) {
                            return {
                                "wilayah": item.wilayah,
                                "nama_wilayah": item.nama_wilayah,
                                "tahun": item.tahun,
                                "jumlah": item.jumlah,
                                "kode_item": item.kode_item,
                                "nama_item": item.nama_item
                            };
                        }
                        return null;
                    });
                    
                    const itemChildDrilldown = transformChildDrilldown.filter(item => item !== null);

                    const transformChildSeries = (data) => {
                        const map = new Map();
                    
                        data.forEach(entry => {
                            const id = `${entry.nama_wilayah}-${entry.tahun}`;
                            const key = entry.nama_item;
                            const amount = parseInt(entry.jumlah, 10);
                    
                            if (!map.has(id)) {
                                map.set(id, {
                                    id: id,
                                    name: `${entry.nama_wilayah} ${entry.tahun}`,
                                    data: []
                                });
                            }
                    
                            const regionData = map.get(id);
                            const itemEntry = regionData.data.find(d => d[0] === key);
                            
                            if (itemEntry) {
                                itemEntry[1] += amount;
                            } else {
                                regionData.data.push([key, amount]);
                            }
                        });
                    
                        return Array.from(map.values());
                    };
                    
                    const seriesChild = transformChildSeries(itemChildDrilldown);

                    var htmlChartBar = '';
                    let chartIdBar = 'bar_' + loopingParent[u].kode_item;
                    htmlChartBar += '<div class="col-lg-12">';
                    htmlChartBar += '<div class="panel panel-default panel-border" style="border-radius: 30px; border: 1px solid #ccc;">';
                    htmlChartBar += '<div class="panel-body">';
                    htmlChartBar += '<div id="' + chartIdBar + '">';
                    htmlChartBar += '</div>';
                    htmlChartBar += '</div>';
                    htmlChartBar += '</div>';
                    htmlChartBar += '</div>';

                    $('#bar-b1').append(htmlChartBar);
                    Highcharts.chart(chartIdBar, {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'APBD '+loopingParent[u].data[0].nama_item
                        },
                        xAxis: {
                            type: 'category'
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },
                        series: seriesParent,
                        drilldown: {
                            allowPointDrilldown: false,
                            series: seriesChild
                        }
                    });
                }
                $('#loading-animation').hide();
            }
        });
    });
});