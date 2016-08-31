var _INTERVAL = 5000;
var _LEVELS = [];
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
      var level1 = $("#level1").val();
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
          setLevels(JSON.parse(data));
        });
        cl("get fresh res");
      }, _INTERVAL);
    });
    $("#stop").click(function(){
      clearInterval(interval);
      clearInterval(chartRefresh);
    });
});
var chartRefresh;
function setLevels(data) {
  var tempLvl1 = 0;
  var tempLvl2 = 0;
  var tempLvl3 = 0;
  for(var i = 0; data.length > i; i++){
    tempLvl1 += parseInt(data[i].level1);
    tempLvl2 += parseInt(data[i].level2);
    tempLvl3 += parseInt(data[i].level3);
  };

  _LEVELS[0] = tempLvl1 / data.length;
  _LEVELS[1] = tempLvl2 / data.length;
  _LEVELS[2] = tempLvl3 / data.length;

  cl(_LEVELS[0]);
  cl(data.length);

}

function getUnderLevel() {
  return _LEVELS[0] || 0;
}
function getAgreeLevel() {
  return _LEVELS[1] || 0;
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

                        // set up the updating of the chart each second
                        var series = this.series[0];
                        chartRefresh = setInterval(function () {
                            var x = (new Date()).getTime(), // current time
                                y = getUnderLevel();
                            series.addPoint([x, y], true, true);
                        }, _INTERVAL);
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
                            y: Math.random()
                        });
                    }
                    return data;
                }())
            }]
        });
    });
});
