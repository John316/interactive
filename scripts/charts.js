$(function () {
    $(document).ready(function () {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });

      $('#chart-object-1').highcharts({
            chart: {
                marginLeft: 35,
                marginRight: 0,
                events: {
                    load: function () {
                      seriesChart1 = this.series[0];
                    }
                }
            },
            title: {
                text: ""//getTranslate('LEVEL_OF_UNDERSTANDING')
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: getTranslate('LEVEL')
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                        Highcharts.numberFormat(this.y, 2);
                }
            },

            series: [{
                type: 'area',
                name: getTranslate('LEVEL'),
                data: (function () {
                    // generate an array of data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;

                    for (i = -50; i <= 0; i += 1) {
                        data.push({
                            x: time + i * 1000,
                            y: 4.9
                        });
                    }
                    return data;
                }())
            }]
        });
    });
});

$(function () {
    agreeChart = $('#chart-object-2').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false,
            events: {
                load: function () {
                    seriesChart2 = this.series[0];
                }
            }
        },
        title: {
            text: "",//getTranslate('THE_LEVEL_OF_AGREEMENT'),
            align: 'center',
            verticalAlign: 'middle',
            y: 40,
            style:{"fontSize": "14px" }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: false,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%']
            }
        },
        series: [{
            type: 'pie',
            name: getTranslate('LEVEL'),
            innerSize: '50%',
            data: [{
              y: 10,
              name:  getTranslate("NO"),
              color: '#f7a35c'
            }, {
                y: 90,
                name: getTranslate("YES"),
                color: '#90ed7d'
            }]
        }]
    });
});

$(function () {
    agreeChart = $('#chart-object-3').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false,
            events: {
                load: function () {
                    seriesChart3 = this.series[0];
                }
            }
        },
        title: {
            text: "",//getTranslate('THE_LEVEL_OF_AGREEMENT'),
            align: 'center',
            verticalAlign: 'middle',
            y: 40,
            style:{"fontSize": "14px" }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: false,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%']
            }
        },
        series: [{
            type: 'pie',
            name: getTranslate('LEVEL'),
            innerSize: '50%',
            data: [{
              y: 10,
              name:  getTranslate("NO"),
              color: '#f15c80'
            }, {
                y: 90,
                name: getTranslate("YES"),
                color: '#7cb5ec'
            }]
        }]
    });
});


// chart fo presentation
$(function () {
    $(document).ready(function () {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });

      $('#chart-1').highcharts({
            chart: {
                marginLeft: 35,
                marginRight: 0,
                events: {
                    load: function () {
                      demoChart1 = this.series[0];
                    }
                }
            },
            title: {
                text: getTranslate('UNDERSTANDING')
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: getTranslate('LEVEL')
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            tooltip: {
                formatter: function () {
                    return Highcharts.numberFormat(this.y, 2);
                }
            },

            series: [{
                type: 'area',
                name: getTranslate('LEVEL'),
                data: (function () {
                    // generate an array of data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;

                    for (i = -50; i <= 0; i += 1) {
                        data.push({
                            x: time + i * 1000,
                            y: 4.9
                        });
                    }
                    return data;
                }())
            }]
        });
    });
});


$(function () {
    $('#chart-2').highcharts({
        chart: {
            events: {
                load: function () {
                    demoChart2 = this.series[0];
                }
            },
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: [getTranslate('RELEVANCE'), getTranslate('INTEREST')]
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },

        tooltip: {
            headerFormat: '{point.x}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: false,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
        series: [{
            name: getTranslate('YES'),
            data: [10, 10]
        }]
    });
});
