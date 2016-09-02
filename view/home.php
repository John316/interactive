<div class="main">
  <h1>Home page</h1>
  <div class="toolButtons">
    <input type="button" name="name" id="start" value="Start">
    <input type="button" name="name" id="stop" value="Stop">
  </div>
  <div class="status">
    <div id="understandChart" style="width:60%; float:left;">
    </div>
    <div id="agreeChart" style="width:40%; float:right;">
    </div>
    <p>
      <label for="level1">Я понимаю на:</label>
      <input type="text" id="level1" readonly style="width: 23px; border:0; color:#f6931f; font-weight:bold;">%
    </p>
    <div id="slider-vertical" style="height:200px;"></div>
  </div>
  <div class="tools">
      <label for="agree">Agree level</label>
      <input type="button" name="name" id="iAgree" value="Согласен">
      <input type="button" name="name" id="iDisagree" value="Не согласен">
      <input type="hidden" name="level2" id="level2" value="10">
      <input type="button" name="name" id="sendLevel" value="Send">

      <input type="hidden" name="level3" value="0">
  </div>
</div>
