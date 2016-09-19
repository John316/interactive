<?php
  $mode = strip_tags($_GET['mode']);
  $id = strip_tags($_GET['id']);
  $userId = $_SESSION['id'];
  if ($mode == "remove") {
    removeEvent($id);
  }
?>

<?php
  if ($url === "event" && $mode === "create") { ?>
    <h1>Create event</h1>
    <form action="admin.php?url=create" method="post">
      <div class="form-group">
          <label for="inputEventName">Name of event</label>
          <input type="text" id="inputEventName" name="name" class="form-control" placeholder="Name">
      </div>
      <div class="form-group">
          <label for="inputEventName">Start date</label>
          <input type="date" name="startDate" id="startDate" class="form-control">
      </div>
      <div class="form-group">
          <label for="inputEventName">End date</label>
          <input type="date" name="endDate" id="endDate" class="form-control">
      </div>
      <input type="hidden" name="userId" value="<?php echo $userId;?>">
      <button type="submit" class="btn btn-default">Send</button>
    </form>
  <?php }else if ($url === "event" && $mode === "update") {
    $event = getEvent($eventId);
    ?>
    <h1>Create event</h1>
    <form action="admin.php?url=update&id=<?php echo $eventId; ?>" method="post">
      <div class="form-group">
          <label for="inputEventName">Name of event</label>
          <input type="text" id="inputEventName" name="name" value="<?php echo $event['name'];?>" class="form-control" placeholder="Name">
      </div>
      <div class="form-group">
          <label for="inputEventName">Start date</label>
          <input type="date" name="startDate" id="startDate" value="<?php echo $event['start_date'];?>" class="form-control">
      </div>
      <div class="form-group">
          <label for="inputEventName">End date</label>
          <input type="date" name="endDate" id="endDate" value="<?php echo $event['end_date'];?>" class="form-control">
      </div>
      <input type="hidden" name="userId" value="<?php echo $userId;?>">
      <button type="submit" class="btn btn-default">Send</button>
    </form>
  <?php }else{
    $events = loadEventList($userId); ?>
    <h1>List of events</h1>
    <div class="event-tools">
      <a class="btn btn-primary" href="admin.php?url=event&mode=create" role="button">Create Event</a>
    </div>
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Delete</th>
        </tr>
  <?php while($row = mysql_fetch_assoc($events)){ ?>
       <tr>
           <td><a href="?url=event&mode=update&id=<? echo $row['id']; ?>"><? echo $row['name']; ?></a></td>
           <td><? echo $row['start_date']; ?></td>
           <td><? echo $row['end_date']; ?></td>
           <td><a href="admin.php?url=event&mode=remove&id=<? echo $row['id']; ?>">Remove</a></td>
       </tr>
       <?  } ?>
    </table>
 <?php } ?>
