<?php
session_start();

if (!$_SESSION['userid']) {
  header('location: index.php');
}

$userId = $_SESSION['userid'];

function showTask($id)
{
  $connection = new mysqli('localhost', 'root', '', 'todo');
  $showTaskQuery = "SELECT * FROM tasks WHERE id = $id";
  $taskS = $connection->query($showTaskQuery)->fetch_assoc();
  $lebelId = $taskS['lebel_id'];

  $showLebelQuery = "SELECT * FROM lebels WHERE id = $lebelId";
  $lebelN = $connection->query($showLebelQuery)->fetch_assoc();


  if (empty($lebelN)) {
    $colorCode = "#eedebf";
    $lebelName = "Daily";
  } else {
    $colorCode = $lebelN['color_code'];
    $lebelName = $lebelN['name'];
  }

  $taskName = $taskS['name'];
  $date = $taskS['date'];
  $priority = $taskS['priority'];
  $today = date('Y-m-d');
  $day = "Today";



?>
  <div class="card m-auto mb-3 shadow" style="background-color: <?php echo $colorCode ?>; border: 1px solid transparent">
    <div class="card-body">
      <div class="row">
        <div class="col-md-1">
          <input type="checkbox" class="mx-3 my-2" name="checked_id[]" value=" <?php echo $taskS["id"]; ?>" />
        </div>
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-12">
              <p><strong><?php echo $taskName ?></strong></p>
            </div>
            <div class="col-md-12 d-flex">
              <p class="badge bg-primary"><?php echo $date ?></p>
              <p class="badge bg-danger mx-1"><?php echo $priority ?></p>
              <p class="badge bg-secondary"><?php echo $lebelName ?></p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <a class="btn btn-md btn-warning" style="float: right;" href="updateTask.php?id=<?php echo ($taskS["id"]); ?>">Update</a>
          <a class="btn btn-md btn-danger" style="float: right;" href="deleteTask.php?id=<?php echo ($taskS["id"]); ?>">Delete</a>
        </div>
      </div>
    </div>
  </div>
<?php

}
