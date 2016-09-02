<?php
require '../modules/level_module.php';
$level = new Level();

if ($_POST) {
    $level1 = $_POST['level1'];
    $level2 = $_POST['level2'];
    $level3 = $_POST['level3'];
    $id = $level->AddLevel(1, $level1, $level2, $level3);
    return $id;
}

if($_GET){
  $data = $level->SelectAVGLevels();
  echo json_encode(mysql_fetch_assoc($data));
}
?>
