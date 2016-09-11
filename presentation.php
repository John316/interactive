<?php
    header("Content-type: text/html;charset=utf-8");
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8" />
  <link rel="stylesheet" href="css/style.css">
  <script src="scripts/jquery-3.1.0.min.js"></script>
  <script src="scripts/highcharts.js"></script>
  <script src="scripts/script.js"></script>
  <script src="scripts/demo-script.js"></script>
  <script src="scripts/charts.js"></script>
  <script src="scripts/chart-themes.js"></script>
  <script src="scripts/lang.js"></script>
</head>
<body class="body">
  <div class="main-window">
    <div class="demo-info">
      <div>
        <span class="lang" text="CONNECT_TO_WIFI">Connect to WiFI - Mne_ne_zhalko. Enter in your browser address </span><? echo $_SERVER[SERVER_NAME]; ?>
      </div>
    </div>
    <div class="slide-frame">
      <div class="image-frame">
        <?php include ('controllers/show_image.php'); ?>
      </div>
    </div>
    <div id="message-aside">
      <!-- <div class="message-body">
        <div class="mess-cancel">x</div>
        <div class="message-text">
          Очень сложный вопрос?
        </div>
      </div> -->

    </div>
    <div class="clear">

    </div>
    <div class="tools-frame">
      <div id="chart-1" style="height: 164px; width: 800px;"></div>
      <!-- <div id="chart-2" style="height: 200px; width: 300px;"></div> -->
    </div>
  </div>
</body>
