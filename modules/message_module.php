<?php
require_once '../db/connectmysql.php';
class Message{
		private $id;
		private $userId;
		private $text;
		private $rank;
		private $datatime;
		private $status;
    private $type; // question, answer, comment

    function __construct(){
        $connect = new ConnectMysql();
        $connect->Connect();
    }

    function AddMessage($userId, $text, $rank, $type){
		    $query = mysql_query("INSERT INTO `message` (userId, `text`, rank, type, status) VALUES ( $userId, '$text', $rank, $type, 1)")
        or die(mysql_error());
        return true;
    }

    function SelectMessage (){
  		$select = "SELECT `id`, `text`, `rank`, `type`
      FROM `message` WHERE `dateTime`>= NOW() - INTERVAL 1 DAY
      AND status = 1
      ORDER BY `rank` DESC";
  		$result = mysql_query($select) or die(mysql_error());
  		return $result;
  	}

		function RemoveMessage ($id){
			$reqest = "UPDATE `message` SET `status` = 0 WHERE id = $id";
  		mysql_query($reqest) or die(mysql_error());
      return true;
  	}

    function DeleteMessage ($id){
  		$reqest = "DELETE FROM `message` WHERE id = $id";
  		mysql_query($reqest) or die(mysql_error());
      return true;
  	}
}
?>
