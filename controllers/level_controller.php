<?php
require '../modules/level_module.php';
if ($_POST) {
    $level = new Level();
    $level1 = $_POST['level1'];
    $level2 = $_POST['level2'];
    $level3 = $_POST['level3'];
    $id = $level->AddLevel(1, $level1, $level2, $level3);
    return $id;
}

?>
