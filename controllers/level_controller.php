<?php
require '../modules/level_module.php';

$url = $_GET['url'];
if($url === 'start'){

  $isActive = fopen("../db/isActive.txt", "w") or die("Unable to open file!");
  $status = "active";
  fwrite($isActive, $status);
  fclose($isActive);
  echo json_encode("active");

}else if($url === 'stop'){

  $isActive = fopen("../db/isActive.txt", "w") or die("Unable to open file!");
  $status = "not active";
  fwrite($isActive, $status);
  fclose($isActive);
  echo json_encode("not active");

} else if ($url === 'addLevel') {

    $level = new Level();
    $level1 = $_POST['level1'];
    $level2 = $_POST['level2'];
    $level3 = $_POST['level3'];
    $clientIP  = $_POST['clientIP'];
    $userId  = $_POST['userId'];
    $id = $level->AddLevel($userId, $clientIP, $level1, $level2, $level3);
    return $id;

} else if($url === 'selectLevels'){

  $level = new Level();
  $data = $level->SelectAVGLevels();
  echo json_encode(mysql_fetch_assoc($data));

}else if($url === 'isactive'){

  $myfile = fopen("../db/isActive.txt", "r") or die("Unable to open file!");
  echo fread($myfile,filesize("../db/isActive.txt"));
  fclose($myfile);

}else if($url === 'clientCount'){

  $level = new Level();
  $data = $level->SelectUniqueClients();
  echo json_encode(mysql_fetch_assoc($data));

}

?>
