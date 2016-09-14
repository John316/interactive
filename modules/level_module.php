<?php
require_once '../db/connectmysql.php';
class Level{
		private $id;
		private $level1;
		private $level2;
		private $level3;
		private $userId;
		private $typeId;

    function __construct(){
        $connect = new ConnectMysql();
        $connect->Connect();
    }

    function AddLevel($userId, $clientIP, $level1, $level2, $level3, $typeId){
		    $query = mysql_query("INSERT INTO `level` (level1, level2, level3, typeId, userId, clientIP)
															VALUES ($level1, $level2, $level3, $typeId, $userId, '$clientIP')")
    												or die(mysql_error());
        $queryid = mysql_insert_id();
        return $queryid;
        //header('Location: index.php?url=view');
    }

		function SelectUniqueClients(){
			$level_row = mysql_query("SELECT COUNT(DISTINCT `userId`) AS clients
																FROM LEVEL")
																or die(mysql_error());
			return $level_row;
		}

		function SelectAVGLevels(){
			$level_row = mysql_query("SELECT AVG(`level1`) AS lvl1,
																       AVG(`level2`) AS lvl2,
																       AVG(`level3`) AS lvl3
																FROM `level`
																WHERE `time`>= NOW() - INTERVAL 30 SECOND")
																or die(mysql_error());
			return $level_row;
		}
		public function GetMainStatistic()
		{
			$request = mysql_query("SELECT lvl, SUM(  `count_lvl2` ) AS count_lvl2, SUM(  `count_lvl3` ) AS count_lvl3
															FROM (
																SELECT  `level2` AS lvl, COUNT(  `level2` ) AS count_lvl2, 0 AS count_lvl3
																	FROM  `level`
																	WHERE  `typeId` = 1
																	GROUP BY  `level2`
															UNION ALL
																SELECT  `level3` , 0, COUNT(  `level3` )
																	FROM  `level`
																	WHERE  `typeId` = 1
																	GROUP BY  `level3`
															)TEMP
															GROUP BY lvl")
															or die(mysql_error());
			return $request;
		}

		public function GetMiddleValue(){

			$request = mysql_query("SELECT COUNT(d.`userId`) AS total_users,
       												ROUND(AVG(d.`level1`),2) AS middle_value
															FROM
															  (SELECT a.`userId`,

															     (SELECT b.`level1`
															      FROM `level` b
															      WHERE b.`typeId` = 0
															        AND b.`userId` = a.`userId`
															      ORDER BY b.`time` DESC LIMIT 1) AS level1
															   FROM `level` a
															   WHERE a.`typeId` = 0
															   GROUP BY a.`userId`) d")
										 					 or die(mysql_error());

							 			 return $request;
		}
}
