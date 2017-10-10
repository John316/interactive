<?php
require_once '../db/connectmysql.php';
require_once 'message_module.php';

function convertToArray($data)
{
	$result = array();
	while ($row = mysql_fetch_assoc($data)) {
			$result[] = $row;
	}
	return $result;
}

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

    function AddLevel($userId, $clientIP, $level1, $level2, $level3, $typeId, $event_id){
		    $query = mysql_query("INSERT INTO `level` (level1, level2, level3, typeId, userId, clientIP, event_id)
															VALUES ($level1, $level2, $level3, $typeId, $userId, '$clientIP', $event_id)")
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
		public function GetMainStatistic($event_id)
		{
			$request = mysql_query("SELECT lvl, SUM(  `count_lvl2` ) AS count_lvl2, SUM(  `count_lvl3` ) AS count_lvl3
															FROM (
																SELECT  `level2` AS lvl, COUNT(  `level2` ) AS count_lvl2, 0 AS count_lvl3
																	FROM  `level`
																	WHERE  `typeId` = 1
																	AND  `event_id` = $event_id
																	GROUP BY  `level2`
															UNION ALL
																SELECT  `level3` , 0, COUNT(  `level3` )
																	FROM  `level`
																	WHERE  `typeId` = 1
																	AND  `event_id` = $event_id
																	GROUP BY  `level3`
															)TEMP
															GROUP BY lvl")
															or die(mysql_error());
			return $request;
		}

		public function GetMiddleValue($event_id){

			$request = mysql_query("SELECT COUNT(d.`userId`) AS total_users,
       												ROUND(AVG(d.`level1`),2) AS middle_value
															FROM
															  (SELECT a.`userId`,

															     (SELECT b.`level1`
															      FROM `level` b
															      WHERE b.`typeId` = 0
															        AND b.`userId` = a.`userId`
																			AND  `event_id` = $event_id
															      ORDER BY b.`time` DESC LIMIT 1) AS level1
															   FROM `level` a
															   WHERE a.`typeId` = 0
																 AND  `event_id` = $event_id
															   GROUP BY a.`userId`) d")
										 					 or die(mysql_error());

							 			 return $request;
		}
		public function GetAVGlevelForEvent($event_id)
		{
			$request = mysql_query("SELECT ROUND(AVG(`level`),2) AS avg_level
															FROM
															(SELECT AVG(  `level1` ) AS level
															FROM  `level`
															WHERE  `typeId` = 0
															AND  `event_id` = $event_id
															GROUP BY  `userId`) AS result_table")
														or die(mysql_error());

											return $request;
		}

		public function InitArchivation($event_id = 1)
		{
			$level = new Level();
			$resOfLvl1 = $level->GetAVGlevelForEvent($event_id);
			$resOfLvl2_3 = $level->GetMainStatistic($event_id);
			$level1 = serialize(convertToArray($resOfLvl1));
			$Levels2_3 = serialize(convertToArray($resOfLvl2_3));

			$message = new Message();
			$question = serialize(convertToArray($message->SelectMessage()));

			$query = mysql_query("INSERT INTO `archive` (level1, level2_3, questions, event_id)
														VALUES ('$level1', '$Levels2_3', '$question', $event_id)")
													or die(mysql_error());
		}
}
