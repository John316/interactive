var _INTERVAL = 5000;
var _LEVELS = [];
var series;
var remLevel1 = 0;
var remLevel2 = 0;
var remLevel3 = 0;
var colorNo = "#00FF00"
var colorYes = "#FF00FF"

function sendGet(url, callbeak){
  $.get(url)
  .done(function( data ) {
    if(callbeak){
      callbeak(data);
    }
    cl( "Data Loaded.");
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
    cl( "Post request done.");
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
    $("#sendLevel").click(function(){
      var level1 = $("#level1").val()/10;
      var level2 = $("#level2").val();
      var url = "controllers/level_controller.php";
      var data = {level1: level1, level2:level2, level3:0};
      sendPost(url, data);
    });
    var interval;
    $("#start").click(function(){
      var url = "controllers/level_controller.php?url";
      interval = setInterval(function(){
        sendGet(url, function (data) {
          setLevelsAndUpdate(JSON.parse(data));
        });
      }, _INTERVAL);


    });
    $("#stop").click(function(){
      clearInterval(interval);
      clearInterval(chartRefresh);
    });

    $("#iDisagree").click(function(){
      $("#level2").val(1);
    });

    $("#iAgree").click(function(){
      $("#level2").val(10);
    });

});
var chartRefresh;
function setLevelsAndUpdate(data) {
  _LEVELS = data;
  // start Refresh chart
  updateUnder();
  updateAgree();
}

function getUnderLevel() {
  var val = parseInt(_LEVELS.lvl1);
  if(val > 0){
    var result = val;
    remLevel1 = val;
  }else{
    var result = remLevel1;
  }
  return result;
}

function getAgreeLevel() {
  var val = parseInt(_LEVELS.lvl2);
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
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
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
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Level'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: 'Random data',
                data: (function () {
                  // generate an array of random data
                  var data = [],
                      time = (new Date()).getTime(),
                      i;

                  for (i = -19; i <= 0; i += 1) {
                      data.push({
                          x: time + i * 1000,
                          y: 1
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
            text: 'Уровень<br>согласия<br>аудитории',
            align: 'center',
            verticalAlign: 'middle',
            y: 40
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

$( function() {
    $( "#slider-vertical" ).slider({
      orientation: "horizontal",
      range: "min",
      min: 0,
      max: 100,
      value: 60,
      slide: function( event, ui ) {
        $( "#level1" ).val( ui.value );
      }
    });
    $( "#level1" ).val( $( "#slider-vertical" ).slider( "value" ) );
} );

$( function() {
    $( "#interest-slider" ).slider({
      orientation: "horizontal",
      range: "min",
      min: 0,
      max: 100,
      value: 60,
      slide: function( event, ui ) {
        $( "#level3" ).val( ui.value );
      }
    });
    $( "#level3" ).val( $( "#interest-slider" ).slider( "value" ) );
} );
