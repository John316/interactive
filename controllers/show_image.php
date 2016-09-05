<?php
$flag = 0;
$dir = "upload/slides/1/";
if (is_dir($dir)) {
  if ($dh = opendir($dir)) {
      while (($file = readdir($dh)) !== false) {
          if($file !== ".." && $file !== "."){
            if($flag === 0){
              echo "<img src='upload/slides/1/".$file."' class='img-slide active' alt='slide 1' />";
              $flag++;
            }else {
              echo "<img src='upload/slides/1/".$file."' class='img-slide' alt='slide 1' />";
            }
          }
      }
      closedir($dh);
  }
}
?>
