var _INTERVAL = 5000;
var _LEVELS = [];
var series;
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

    $("#checkboxAgree").click(function(){
      if(agreeOrNo === 10){
        agreeOrNo = 1;
      }else{
        agreeOrNo = 10;
      }
      $("#level2").val(agreeOrNo);
      initSendInfo();
    });
    $("[name='radio']").click(function(){
        initSendInfo();
    });
    function regularEvents() {
      if(flag){
        flag = false;
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
  updateUnder();
  updateAgree();
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
    var level1 = $('[name="radio"]:checked').val();
    var level2 = $("#level2").val();
    var url = "controllers/level_controller.php?url=addLevel";
    var data = {level1: level1, level2:level2, level3:0};
    sendPost(url, data, function () { isActive = false; });

  }, 2000);
}

function getUnderLevel() {
  var val = parseFloat(_LEVELS.lvl1);
  if(val > 0){
    var result = val;
    remLevel1 = val;
  }else{
    var result = remLevel1;
  }
  return result;
}

function getAgreeLevel() {
  var val = parseFloat(_LEVELS.lvl2);
  if(val > 0){
    var result = val;
    remLevel1 = val;
  }else{
    var result = remLevel2;
  }
  return result;
}

function updateUnder() {
  var x = (new Date()).getTime(), // current time
      y = getUnderLevel();
  series.addPoint([x, y], true, true);
}

function updateAgree() {
  var agree = getAgreeLevel();
  var disagree = 10 - agree;
  seriesAgree.setData([{
    y: disagree,
    name: "No",
    color: colorNo
  }, {
      y: agree,
      name: "Yes",
      color: colorYes
  }], true)
}

$(function () {
    $(document).ready(function () {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });

        $('#understandChart').highcharts({
            chart: {
                marginLeft: 35,
                marginRight: 0,
                events: {
                    load: function () {
                      series = this.series[0];
                    }
                }
            },
            title: {
                text: 'Level of understanding'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'rate'
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
                name: 'Level',
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
var agreeChart;
var seriesAgree;
$(function () {
    agreeChart = $('#agreeChart').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false,
            events: {
                load: function () {
                    seriesAgree = this.series[0];
                }
            }
        },
        title: {
            text: ' <br>The level<br>of agreement',
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
            name: 'Уровень',
            innerSize: '50%',
            data: [
                ['Yes',   90],
                ['No',       10],
                {
                    name: 'Proprietary or Undetectable',
                    y: 0.2,
                    dataLabels: {
                        enabled: false
                    }
                }
            ]
        }]
    });
});
