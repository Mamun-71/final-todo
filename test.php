<?php
include 'database.php';
require_once 'showTaskFunction.php';

// $userId ;



if (!$_SESSION['userid']) {
  header('location: index.php');
}

$userId = $_SESSION['userid'];

// 
?>

<!DOCTYPE html>

<head>

  <title>Todo list</title>
  <style>
    body {
      padding: 0;
      margin: 0;
      /* background: url('background.jpg'); */
      background-size: cover;
      background-repeat: no-repeat;
    }
  </style>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>




  <div class="container">
    <div class="row">
      <div class="col-8 m-auto">
        <h2 class="display-4 text-center">To Do List</h2>
      </div>
      <div class="col-2">
        <form action="logout.php" class="col " method="post">
          <input class="btn btn-dark" type="submit" value="Logout">
        </form>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-8 text-center my-4">
        <a class="w-50 btn btn-primary btn-lg btn-block" href="addTask.php" role="button">Add Task</a>
      </div>
      <div class="col-2 my-4">
        <form action="showLebel.php" class="col-2 " method="post">
          <input class="btn btn-info btn-lg" type="submit" value="Lebels">
        </form>
      </div>
    </div>
  </div>




  <?php

  $today = date('Y-m-d');
  $taskShowQuery =  "SELECT * FROM tasks WHERE user_id = $userId";
  $listOfTodo = $connection->query($taskShowQuery)->fetch_all();
  $lebelQuery = "SELECT * FROM lebels WHERE user_id = $userId";
  $listOfLebel = $connection->query($lebelQuery)->fetch_all();

  // var_dump($listOfTodo);
  // $listOfTodo['id'];

  //  var_dump($listOfTodo);

  if (empty($lebelN)) {
    $colorCode = "#eedebf";
    $lebelName = "Daily";
  } else {
    $colorCode = $listOfLebel['color_code'];
    $lebelName = $listOfLebel['name'];
  }

  // var_dump($listOfTodo);

  if (empty($listOfTodo)) {
  ?>
    <h1 class="m-auto text-center">No Task</h1>
  <?php
  } else {
  ?>
    <!-- <input type="submit" class="btn btn-danger" name="bulk_delete_submit" onclick="return confirm('Are you sure?')" value="Delete"/> -->


    <div class="container">

      <div class="row">

        <div class="col-8 m-auto">

        </div>

      </div>
    </div>

    <div class="w-75 d-flex justify-content-center align-items-center mx-auto">
      <form class="w-75" name="bulk_action_form" action="deleteTask.php" method="post">
        <div><input type="submit" class="btn btn-danger my-4" style="text-align: right;" name="bulk_delete_submit" value="Delete By Group" /></div>

        <div class="w-100">
          <?php
          $ok = false

          /// Today
          foreach ($listOfTodo as $row) {
            var_dump($row);
            echo $row["id"];
            die();
            $id = $row['id'];
            $date = $row['date'];

            if ($date == $today) {
              if ($ok == false) {
          ?>
                <h4>Today Tasks</h4>
              <?php
                $ok = true;
              }

              showTask($listOfTodo,$listOfLebel);
            }
          }

          $ok = false;

          /// Upcoming

          foreach ($listOfTodo as $row) {
            $id = $row['id'];
            $date = $row['date'];

            if ($date > $today) {
              if ($ok == false) {
              ?>
                <h4>Upcoming Tasks</h4>
              <?php
                $ok = true;
              }
              showTask($listOfTodo,$listOfLebel);
            }
          }

          /// Overdue

          $ok = false;
          foreach ($listOfTodo as $row) {
            $id = $row['id'];
            $date = $row['date'];

            if ($date < $today) {
              if ($ok == false) {
              ?>
                <h4>Overdue Tasks</h4>
          <?php
                $ok = true;
              }
              showTask($listOfTodo,$listOfLebel);
            }
          }

          ?>
        </div>
      </form>

    <?php
  }
    ?>



</body>

</html>