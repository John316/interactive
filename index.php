<?php
    $url = $_GET['url'];
    $id = $_GET['id'];
    session_start();
    require 'controlers/edituser.php';
    require 'modules/user_module.php';
    require 'controlers/level.php';
    header("Content-type: text/html;charset=utf-8");
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8" />
	<meta name="author" content="" />
	<title>Consumer list</title>
    <style type="text/css">
        body, a, td, th{
            padding: 10px;
        }
    </style>
</head>

<body>
    <div id="page">
        <div id="mine">
            <div id="center">
            <? if($_POST['login'] == 'admin' && $_POST['pass'] == 'admin'){
			     $_SESSION['ENTER'] = 'ok';
            }
            if($url == 'exit'){
                $_SESSION['ENTER'] = 'none';
            }
            if($_SESSION['ENTER'] == 'ok'){
            ?>
                <h1>Consumers</h1>
                <div id="menu">
                    <span><a href="index.php?url=adduser">Добавить абонента</a></span>
                    <span><a href="index.php?url=view">Просмотреть абонентов</a></span>
                    <span><a href="index.php?url=addgr">Добавить группы</a></span>
                    <span><a href="index.php?url=viewgr">Просмотреть группы</a></span>
                    <span><a href="index.php?url=exit">Выход</a></span>
                </div>
                <div id="content">
                    <?php
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
                    ?>

                </div>
            <? }else{ ?>
                <form action="index.php" method="POST" >
                    <label for="login">Login</label>
                    <input type="text"  name="login"/>
                    <label for="pass">Password</label>
                    <input type="password"  name="pass"/>
                    <input type="submit"  value="OK"/>
                </form>
           <? }?>
            </div>
            <div id="right">
            </div>
        </div>

    </div>



</body>
</html>
