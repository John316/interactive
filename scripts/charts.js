class PieChart {
  constructor(nodeId, settings, data, update) {
    this.nodeId = nodeId;
    this.data = data;
    this.update = update;
    setTitle(settings.title);
  }

  static setTitle(title){
    this.title = title;
  }

  static getTitle(){
    return this.title ? this.title : "";
  }

  static initChart() {
    $('#' + nodeId).highcharts({
        chart: {
            events: {
                load: function () {
                    seriesChart3 = this.series[0];
                }
            },
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: getTitle()
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Уровень интереса',
            colorByPoint: true,
            data: [{name: 'Сильный', y: 1}]
        }]
    });
  }
};

// end Class

$(function () {
    $(document).ready(function () {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });

      $('#chart-object-1').highcharts({
            chart: {
                marginLeft: 0,
                marginRight: 0,
                events: {
                    load: function () {
                      seriesChart1 = this.series[0];
                    }
                }
            },
            title: {
                text: ""//
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: getTranslate('LEVEL')
                },
                min:0,
                max:5
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
                        radius: 0
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
                            y: 5
                        });
                    }
                    return data;
                }())
            }]
        });
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
                },
                min:0,
                max:5
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
$(function () {
    $('#chart-object-2').highcharts({
        chart: {
            events: {
                load: function () {
                    seriesChart2 = this.series[0];
                }
            },
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Аудитория владеет данной темой так:'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Уровень знаний',
            colorByPoint: true,
            data: [{
                name: 'Хорошо',
                y: 1
            }, {
                name: 'Средне',
                y: 1
            }, {
                name: 'Слабо',
                y: 1
            }, {
                name: 'Не владею',
                y: 1
            }]
        }]
    });
});

$(function () {
    $('#chart-object-3').highcharts({
        chart: {
            events: {
                load: function () {
                    seriesChart3 = this.series[0];
                }
            },
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Интерес аудитории к данной теме такой:'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Уровень интереса',
            colorByPoint: true,
            data: [{
                name: 'Сильный',
                y: 1
            }, {
                name: 'Средний',
                y: 1
            }, {
                name: 'Слабый',
                y: 1
            }, {
                name: 'Нет',
                y: 1
            }]
        }]
    });
});
