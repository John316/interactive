<?php
    $url = $_GET['url'];
    $id = $_GET['id'];
    session_start();
    header("Content-type: text/html;charset=utf-8");
    require 'modules/user_module.php';
    require 'modules/event_module.php';
    require 'controllers/event_controller.php';
    require 'controllers/user_controller.php';

    if($_POST['login'] && $_POST['pass']){
      $userService = new User();
      $userId = $userService->IsUserAvailable($_POST['login'], $_POST['pass']);

      if($userId['id'] > 0){
        $_SESSION['ENTER'] = 'ok';
        $_SESSION['id'] = $userId['id'];
      }
    }
    if($url == 'exit'){
      $_SESSION['ENTER'] = 'none';
      $_SESSION['id'] = 0;
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Admin page</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/admin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="scripts/jquery-3.1.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="scripts/jquery-3.1.0.min.js"><\/script>')</script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="scripts/ie10-viewport-bug-workaround.js"></script>
  </head>

  <body>

    <div class="container">
      <?php if($_SESSION['ENTER'] == 'ok'){ ?>
        <nav class="navbar navbar-inverse navbar-fixed-top">
              <div class="container-fluid">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#">Project name</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Settings</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="admin.php?url=exit">Exit</a></li>
                  </ul>
                  <form class="navbar-form navbar-right">
                    <input type="text" class="form-control" placeholder="Search...">
                  </form>
                </div>
              </div>
            </nav>

            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                  <ul class="nav nav-sidebar">
                    <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
                    <li><a href="admin.php?url=event">Events</a></li>
                    <li><a href="#">Votings</a></li>
                    <li><a href="#">Slides</a></li>
                  </ul>
                  <ul class="nav nav-sidebar">
                    <li><a href="admin.php?url=addgr">Add group</a></li>
                    <li><a href="admin.php?url=viewgr">Display groups</a></li>
                    <li><a href="admin.php?url=adduser">Add user</a></li>
                    <li><a href="admin.php?url=view">Display users</a></li>
                  </ul>
                  <ul class="nav nav-sidebar">
                    <li><a href="">Nav item again</a></li>
                    <li><a href="">One more nav</a></li>
                  </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
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
                        }else if($url == 'event'){
                             include ('view/events.php');
                        }else{
                            include ('view/dashboard.php');
                        }

                        if(!empty($message)){
                            echo $message;
                        } ?>

                  </div>
              </div>
          </div>

            <?php }else{ ?>
        <form class="form-signin" action="admin.php" method="POST">
          <h2 class="form-signin-heading">Please sign in</h2>
          <label for="login" class="sr-only">Email address</label>
          <input type="text" id="login" name="login" class="form-control" placeholder="Login" required autofocus>
          <label for="pass" class="sr-only">Password</label>
          <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
      <?php } ?>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="scripts/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
