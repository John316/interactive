var _INTERVAL = 5000;
var _LEVELS = [];
var seriesChart1, seriesChart2, seriesChart3;
var remLevel1 = 0;
var remLevel2 = 0;
var remLevel3 = 0;
var colorNo = "#00FF00"
var colorYes = "#FF00FF"
var agreeOrNo = 10;
var isActiveState = false;
var flag = true;
var isactiveInterval, intervalSelectLevels, sendTimout, isActiveSend, intervalInitSend;

function sendGet(url, callbeak){
  $.get(url)
  .done(function( data ) {
    if(callbeak){
      callbeak(data);
    }
  })
  .fail(function() {
    cl( "error" );
  });
}

function sendPost(url, data, callbeak){
  $.post(url, data)
  .done(function( data ) {
    if(callbeak){
      callbeak(data);
    }
  })
  .fail(function() {
    cl( "error" );
  });
}
function cl(m) {
  console.log(m);
}
function cd(o) {
  console.dir(o);
}

$( document ).ready(function() {
    changeLang();
    isactiveInterval = setInterval(function(){
      var url = "controllers/level_controller.php?url=isactive";
      sendGet(url, function (data) {
        if(data == "active" && !isActiveState){
          initStart();
        }else if(data == "not active" && isActiveState){
          initStop();
        }
      });
    }, 10000);

    $("#start").click(function() {
      sendGet("controllers/level_controller.php?url=start");
      initStart();
    });
    $("#stop").click(function () {
      sendGet("controllers/level_controller.php?url=stop");
      initStop();
    });

    function initStart() {
      $(".blink").show();
      isActiveState = true;
      regularEvents();
    }

    function initStop() {
      $(".blink").hide();
      isActiveState = false;
      clearInterval(intervalSelectLevels);
      clearInterval(intervalInitSend);
      flag = false;
    }

    $("[name='rate1'], [name='rate2'], [name='rate3']").click(function(){
        initSendInfo();
    });

    function regularEvents() {
      if(flag){
        flag = false;
        tryToSend();
        intervalSelectLevels = setInterval(function(){
          var url = "controllers/level_controller.php?url=selectLevels";
          sendGet(url, function (data) {
            setLevelsAndUpdate(JSON.parse(data));
          });
        }, 5000);

        intervalInitSend = setInterval(function(){
          if(!isActiveSend){
            tryToSend();
          }
        }, 20000);
      }
    }
});

function setLevelsAndUpdate(data) {
  _LEVELS = data;
  // start Refresh chart
  updateLevel1();
  updateLevel2();
  updateLevel3();
}

function initSendInfo() {
  if(isActiveSend){
    clearTimeout(sendTimout);
    tryToSend();
  }else{
    tryToSend();
  }

}
function tryToSend() {
  isActive = true;
  sendTimout = setTimeout(function(){
    var level1 = $('[name="rate1"]:checked').val();
    var level2 = $('[name="rate2"]:checked').val();
    var level3 = $('[name="rate3"]:checked').val();
    var url = "controllers/level_controller.php?url=addLevel";
    var data = {level1: level1, level2:level2, level3:level3};
    sendPost(url, data, function () { isActive = false; });

  }, 2000);
}

function getLevel1() {
  var val = parseFloat(_LEVELS.lvl1);
  if(val > 0){
    var result = val;
    remLevel1 = val;
  }else{
    var result = remLevel1;
  }
  return result;
}

function getLevel2() {
  var val = parseFloat(_LEVELS.lvl2);
  if(val > 0){
    var result = val;
    remLevel2 = val;
  }else{
    var result = remLevel2;
  }
  return result;
}

function getLevel3() {
  var val = parseFloat(_LEVELS.lvl3);
  if(val > 0){
    var result = val;
    remLevel3 = val;
  }else{
    var result = remLevel3;
  }
  return result;
}

function updateLevel1() {
  var x = (new Date()).getTime(), // current time
      y = getLevel1();
  seriesChart1.addPoint([x, y], true, true);
}

function updateLevel2() {
  var _level = getLevel2();
  var res = 100 - _level;
  seriesChart2.setData([{
    y: res,
    name:  getTranslate("NO"),
    color: '#f15c80'
  }, {
      y: _level,
      name: getTranslate("YES"),
      color: '#7cb5ec'
  }], true)
}

function updateLevel3() {
  var _level = getLevel3();
  var res = 100 - _level;
  seriesChart3.setData([{
    y: res,
    name:  getTranslate("NO"),
    color: '#f7a35c'
  }, {
      y: _level,
      name: getTranslate("YES"),
      color: '#90ed7d'
  }], true)
}

function dw(m) {
  return document.write(m);
}

function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options) {
  options = options || {};

  var expires = options.expires;

  if (typeof expires == "number" && expires) {
    var d = new Date();
    d.setTime(d.getTime() + expires * 1000);
    expires = options.expires = d;
  }
  if (expires && expires.toUTCString) {
    options.expires = expires.toUTCString();
  }

  value = encodeURIComponent(value);

  var updatedCookie = name + "=" + value;

  for (var propName in options) {
    updatedCookie += "; " + propName;
    var propValue = options[propName];
    if (propValue !== true) {
      updatedCookie += "=" + propValue;
    }
  }

  document.cookie = updatedCookie;
}

function deleteCookie(name) {
  setCookie(name, "", {
    expires: -1
  })
}

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
                    enabled: true,
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
                    enabled: true,
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
