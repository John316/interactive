<?php
    $url = $_GET['url'];
    $id = $_GET['id'];
    session_start();
    header("Content-type: text/html;charset=utf-8");
    require 'modules/user_module.php';
    require 'controllers/user_controller.php';
    if($_POST['login'] == 'admin' && $_POST['pass'] == 'admin'){
      $_SESSION['ENTER'] = 'ok';
      $_SESSION['login'] = $_POST['login'];
    }
    if($url == 'exit'){
      $_SESSION['ENTER'] = 'none';
    }
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="" />
  <link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="/images/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
  <link rel="manifest" href="/images/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/images/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
	<title>Interactive</title>
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/"><span class="lang" text="INTERACTIVE">Interactive</span></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><a href="index.php"><span class="lang" text="HOME">Home</span></a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="lang" text="GROUPS_AND_USERS">Groups and Users</span><span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="dropdown-header"><span class="lang" text="GROUPS">Groups</span></li>
              <li><a href="index.php?url=addgr"><span class="lang" text="ADD_GROUP">Add group</span></a></li>
              <li><a href="index.php?url=viewgr"><span class="lang" text="DISPLAY_GROUPS">Display groups</span></a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header"><span class="lang" text="USERS">Users</span></li>
              <li><a href="index.php?url=adduser"><span class="lang" text="ADD_USER">Add user</span></a></li>
              <li><a href="index.php?url=view"><span class="lang" text="DISPLAY_USERS">Display users</span></a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="lang" text="LANGUAGE">language</span><span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="dropdown-header"><span class="lang" text="SELECT_LANGUAGE">Select language</span></li>
              <li><a onclick="setLang(0)" href="#">English</a></li>
              <li><a onclick="setLang(2)" href="#">Українська</a></li>
              <li><a onclick="setLang(1)" href="#">Руский</a></li>
            </ul>
          </li>
        </ul>
        <?php if($_SESSION['ENTER'] == 'ok'){ ?>
          <ul class="nav navbar-nav navbar-right">
              <li><a><span class="lang" text="HELLO">Hello</span>, <?php echo $_SESSION['login']; ?></a></li>
              <li><a href="/presentation.php" target="_blank">Demo</a></li>
              <li><a href="#" id="start"><span class="lang" text="START">Start</span></a></li>
              <li><a href="#" id="stop"><span class="lang" text="STOP">Stop</span></a></li>
              <li><a href="index.php?url=exit"><span class="lang" text="EXIT">Exit</span></a></li>
            </ul>
        <?php }else{ ?>
          <form class="navbar-form navbar-right" action="index.php" method="POST">
            <div class="form-group">
              <input type="text" placeholder="Login" name="login" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="pass" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success"><span class="lang" text="SIGN_IN">Sign in</span></button>
          </form>
        <?php } ?>
      </div><!--/.navbar-collapse -->
    </div>
  </nav>
    <div id="page">
      <div class="container">
        <?php if($url == 'adduser'){
                  include ('view/form.php');
                }else if($url == 'addgr'){
                    include ('view/form.php');
                }else if($url == 'updategr'){
                    include ('view/form.php');
                }else if($url == 'view'){
                    include ('view/client_list.php');
                }else if($url == 'viewgr'){
                    include ('view/group_list.php');
                 }else if($url == 'update'){
                    include ('view/form.php');
                }else{
                    include ('view/home.php');
                }

                if(!empty($massage)){
                    echo $massage;
                } ?>
        </div>
    </div>

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="scripts/jquery-3.1.0.min.js"></script>
  <script src="scripts/bootstrap.min.js"></script>
  <script src="scripts/highcharts.js"></script>
  <script src="scripts/script.js"></script>
  <script src="scripts/charts.js"></script>
  <script src="scripts/lang.js"></script>
</body>
</html>
