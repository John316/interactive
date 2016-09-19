<?php
header("Content-type: text/html;charset=utf-8");
require '../modules/message_module.php';
function clear($info){
    $data = strip_tags(mysql_escape_string($info));
    return $data;
}
$url = $_GET['url'];
if ($url === 'addQuestion') {

    $question = new Message();
    $userId = clear($_POST['userId']);
    $text = clear($_POST['text']);
    $question->AddMessage($userId, $text, 1, 1);

}else if($url === 'selectMessage'){

  $message = new Message();
  $data = $message->SelectMessage();
  $result = array();
  while ($row = mysql_fetch_assoc($data)) {
      $result[] = $row;
  }
  echo json_encode($result);

}else if ($url === 'deleteMessage') {
  $id = clear($_POST['id']);
  $message = new Message();
  $message->DeleteMessage($id);
}

?>
