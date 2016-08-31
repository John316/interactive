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
  $data = $level->SelectLevel();
  $rows = array();
  while($row = mysql_fetch_assoc($data)){
    array_push($rows, $row);
  }
  echo json_encode($rows);
}
?>
