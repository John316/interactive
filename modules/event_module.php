<?php
require_once 'db/connectmysql.php';

class EventClass
{

  function __construct()
  {
    $connect = new ConnectMysql();
    $connect->Connect();
  }

  public function CreateEvent($user_id, $event_name, $start_date, $end_date)
  {
    $query = mysql_query("INSERT INTO `event` (name, start_date, end_date) VALUES ('$event_name', '$start_date', '$end_date')")
        or die(mysql_error());
        $queryid = mysql_insert_id();
        $this->CreateRelations($user_id, $queryid);
        header('Location: ../admin.php?url=event');
        return $queryid;
  }
  public function CreateRelations($user_id, $event_id)
  {
    $query = mysql_query("INSERT INTO `event_relations` (`user_id`, `event_id`) VALUES ($user_id, $event_id)")
        or die(mysql_error());
    $queryid = mysql_insert_id();
  }
  function RemoveEvent ($id){
		$query = "UPDATE `event` SET `status` = 0 WHERE id = '$id'";
    mysql_query($query) or die(mysql_error());
    return true;
	}
  function UpdateEvent ($id, $event_name, $start_date, $end_date){
		$query = "UPDATE `event` SET `name` = '$event_name', `start_date` = '$start_date', `end_date` = '$end_date' WHERE id = $id";
    mysql_query($query) or die(mysql_error());
    header('Location: ../admin.php?url=event');
    return true;
	}
  public function getEventById($eventId)
  {
    $query = "SELECT e.`name`,
                     e.`start_date`,
                     e.`end_date`
              FROM `event` e
              WHERE e.id = '$eventId'";
		$event = mysql_query($query) or die(mysql_error());
		return mysql_fetch_assoc($event);
  }
  public function getEventList($userId)
  {
    $query = "SELECT e.`id`,
                     e.`name`,
                     e.`start_date`,
                     e.`end_date`,
                     e.`status`
              FROM `event` e
              JOIN event_relations r ON e.id = r.event_id
              AND r.`user_id` = '$userId'
              AND e.`status` = 1";
		$events = mysql_query($query) or die(mysql_error());
		return $events;
  }
}

?>
