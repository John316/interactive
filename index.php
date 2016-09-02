<?php
    $url = $_GET['url'];
    $id = $_GET['id'];
    session_start();
    require 'modules/user_module.php';
    require 'controllers/user_controller.php';
    header("Content-type: text/html;charset=utf-8");

    if($_POST['login'] == 'admin' && $_POST['pass'] == 'admin'){
      $_SESSION['ENTER'] = 'ok';
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
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="scripts/jquery-3.1.0.min.js"></script>
  <script src="scripts/bootstrap.min.js"></script>
  <script src="scripts/jquery-ui.js"></script>
  <script src="scripts/highcharts.js"></script>
  <script src="scripts/script.js"></script>
	<title>Consumer list</title>
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
        <a class="navbar-brand" href="#">Interactive</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Groups and Users<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="dropdown-header">Groups</li>
              <li><a href="index.php?url=addgr">Add group</a></li>
              <li><a href="index.php?url=viewgr">Disply groups</a></li>
              <li role="separator" class="divider"></li>
              <li class="dropdown-header">Users</li>
              <li><a href="index.php?url=adduser">Add user</a></li>
              <li><a href="index.php?url=view">Display users</a></li>
            </ul>
          </li>
          <li><a href="index.php?url=exit">Exit</a></li>
        </ul>
        <form class="navbar-form navbar-right">
          <div class="form-group">
            <input type="text" placeholder="Email" class="form-control">
          </div>
          <div class="form-group">
            <input type="password" placeholder="Password" class="form-control">
          </div>
          <button type="submit" class="btn btn-success">Sign in</button>
        </form>
      </div><!--/.navbar-collapse -->
    </div>
  </nav>
    <div id="page">
      <div class="container">
      <?php if($_SESSION['ENTER'] == 'ok'){
              if($url == 'adduser'){
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
                }
             }else{ ?>
                <form action="index.php" method="POST" >
                    <label for="login">Login</label>
                    <input type="text"  name="login"/>
                    <label for="pass">Password</label>
                    <input type="password"  name="pass"/>
                    <input type="submit"  value="OK"/>
                </form>
           <? }?>
        </div>
    </div>



</body>
</html>
