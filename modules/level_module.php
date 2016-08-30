<?php
require 'connectmysql.php';
class Level{
		private $id;
		private $level1;
		private $level2;
		private $level3;
		private $userId;
		private $isActive;

    function __construct(){
        $connect = new ConnectMysql_temp();
        $connect->Connect();
    }

    function AddLevel($userId, $level1, $level2, $level3){
		    $query = mysql_query("INSERT INTO `level` (level1, level2, level3, isActive, userId) VALUES ( $level1, $level2, $level3, true, $userId)")
        or die(mysql_error());
        $queryid = mysql_insert_id();
        return $queryid;
        //header('Location: index.php?url=view');
    }
}
