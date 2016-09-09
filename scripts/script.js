var _INTERVAL = 5000;
var _LEVELS = [];
var seriesChart1, seriesChart2, seriesChart3, demoChart1, demoChart2;
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
      flag = true;
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
  if(seriesChart1)
    updateLevel1();
  if(seriesChart2)
    updateLevel2();
  if(seriesChart3)
    updateLevel3();
  if(demoChart1)
    updateDemoChart1();
  if(demoChart2)
    updateDemoChart2();
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
  if(!demoChart1){
    isActiveSend = true;
    sendTimout = setTimeout(function(){
      var level1 = $('[name="rate1"]:checked').val();
      var level2 = $('[name="rate2"]:checked').val();
      var level3 = $('[name="rate3"]:checked').val();
      var url = "controllers/level_controller.php?url=addLevel";
      var data = {clientIP: clientIP, level1: level1, level2:level2, level3:level3};
      sendPost(url, data, function () { isActiveSend = false; });

    }, 2000);
  }
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
  // chart of understanding
  var x = (new Date()).getTime(), // current time
      y = getLevel1();
  seriesChart1.addPoint([x, y], true, true);
}

function updateLevel2() {
  // chart of relevance
  var _level = getLevel2();
  var res = 5 - _level;
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
  // chart of interest
  var _level = getLevel3();
  var res = 5 - _level;
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

function updateDemoChart1() {
  // chart of understanding
  var x = (new Date()).getTime(), // current time
      y = getLevel1();
  demoChart1.addPoint([x, y], true, true);
}

function updateDemoChart2() {
  var _level2 = getLevel2();
  var _level3 = getLevel3();
  demoChart2.setData([_level2, _level3], true);
}

addEventListener("keyup", function(event) {
    var forword = 39;
    var backword = 37;
    var down = 40;
    var up = 38;
    var controlFF = 34;
    var controlBK = 33;
    if(event.keyCode == forword || event.keyCode == down || event.keyCode == controlFF){
      initNextSlide();
    }else if (event.keyCode == backword || event.keyCode == up || event.keyCode == controlBK) {
      initPrevSlide();
    }
});

function initNextSlide() {
  var flag1 = false;
  var elArr = $(".img-slide");
  $(elArr).each(function(i) {
    if(flag1){
      $(this).addClass('active');
      return false;
    }else{
      if($(this).hasClass('active')){
        if(i < elArr.length - 1){
          $(this).removeClass('active');
        }
        flag1 = true;
      }
    }
  });
}

function initPrevSlide() {
  var prevEl = false;
  $(".img-slide").each(function(i) {
      if($(this).hasClass('active')){
        if(i>0){
          $(this).removeClass('active');
          $(prevEl).addClass('active');
        }
        return false;
      }else{
        prevEl = this;
      }
  });
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
