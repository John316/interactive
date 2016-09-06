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
  <script src="scripts/charts.js"></script>
  <script src="scripts/chart-themes.js"></script>
  <script src="scripts/lang.js"></script>
</head>
<body class="body">
  <div class="main-window">
    <div class="slide-frame">
      <div class="image-frame">
        <?php include ('controllers/show_image.php'); ?>
      </div>
    </div>
    <div class="tools-frame">
      <div id="chart-1" style="height: 164px; width: 500px;"></div>
      <div id="chart-2" style="height: 200px; width: 300px;"></div>
    </div>
  </div>
</body>
