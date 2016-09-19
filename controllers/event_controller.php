<?php
$url = strip_tags($_GET['url']);
$eventId = strip_tags($_GET['id']);
if ($_POST['name']) {
  $name = $_POST['name'];
  $startDate = $_POST['startDate'];
  $endDate = $_POST['endDate'];
  $userId = $_POST['userId'];
}
if($url === 'create'){
  if ($userId > 0) {
    $eventService = new EventClass();
    $result = $eventService->CreateEvent($userId, $name, $startDate, $endDate);
  }
}
if($url === 'update'){
  $eventService = new EventClass();
  $result = $eventService->UpdateEvent($eventId, $name, $startDate, $endDate);
}
function removeEvent($eventId)
{
  $eventService = new EventClass();
  $eventService->RemoveEvent($eventId);
}

function getEvent($eventId)
{
  $eventService = new EventClass();
  return $eventService->getEventById($eventId);
}

function loadEventList($userId)
{
  $eventService = new EventClass();
  $events = $eventService->getEventList($userId);
  return $events;
}
 ?>
