<?php
include 'database.php';

// $userId ;
session_start();
require_once 'showTaskFunction.php';

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

  

  // $taskShowQuery =  "SELECT * FROM tasks WHERE user_id = $userId";
  // $listOfTodo = $connection->query($taskShowQuery);


//   SELECT Customers.CustomerName, Orders.OrderID
// FROM Customers
// LEFT JOIN Orders ON Customers.CustomerID = Orders.CustomerID
// ORDER BY Customers.CustomerName;
  

  $taskShowQuery = "SELECT 
  tasks.id as task_id,
  tasks.name as task_name,
  tasks.user_id, 
  tasks.date, 
  tasks.lebel_id as lebel_id, 
  tasks.priority,
  FROM tasks 
  JOIN lebels
  ON tasks.lebel_id =  lebels.id
  WHERE tasks.user_id = $userId";

  $listOfTodo = $connection->query($taskShowQuery);
  var_dump($listOfTodo);


  foreach($listOfTodo as $row)
  {
    echo $row['name'];
  }

  die();




// SELECT column_name(s)
// FROM table1
// LEFT JOIN table2
// ON table1.column_name = table2.column_name;

    // $colorCode = "#eedebf";
    // $lebelName = "Daily";

  // var_dump($listOfTodo);
  // $listOfTodo['id'];

  //  var_dump($listOfTodo);
  

  // } else {
  //   $colorCode = $listOfLebel['color_code'];
  //   $lebelName = $listOfLebel['name'];
  // }
  // var_dump($listOfTodo);

  if (empty($listOfTodo)) {
  ?>
    <h1 class="m-auto text-center">No Task</h1>
  <?php
  } else {
  ?>
   


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

          $today = date('Y-m-d');
          $todayTask = [];
          $upComingTask = [];
          $overDueTask = [];

          foreach ($listOfTodo as $row) {

            if ($row['date'] == $today) {
              $todayTask[] = $row;
            }
            else if($row['date'] > $today )
            {
              $upComingTask[] = $row;
            }
            else
            {
              $overDueTask[] = $row;
            }
          }

          if (!empty($todayTask)) {
            ?>

          <h4>Today Task</h4>
          <?php
          }

          echo count($todayTask);

          foreach($todayTask as $row)
          {

            $taskId = $row['id'];
            $taskName = $row['name'];
            $priority = $row['priority'];
            $date = $row['date'];
            $lebelId = $row['lebel_id'];
            $lebelQuery = "SELECT * FROM lebels WHERE id = $lebelId";
            $listOfLebel = $connection->query($lebelQuery)->fetch_assoc();
            $colorCode = "#a0db8e";
            $lebelName = "Regular";


            if(!empty($listOfLebel)) {
              $colorCode =  $listOfLebel['color_code'];
              $lebelName =  $listOfLebel['name'];
            }
            showTask($taskId,$taskName,$date,$priority,$lebelName,$colorCode);

          }

          if (!empty($upComingTask)) {
            ?>
          <h4>Upcoming Task</h4>
          <?php
          }

          foreach($upComingTask as $row)
          {

            $taskId = $row['id'];
            $taskName = $row['name'];
            $priority = $row['priority'];
            $date = $row['date'];
            $lebelId = $row['lebel_id'];
            $lebelQuery = "SELECT * FROM lebels WHERE id = $lebelId";
            $listOfLebel = $connection->query($lebelQuery)->fetch_assoc();
            $colorCode = "#a0db8e";
            $lebelName = "Regular";

            if(!empty($listOfLebel)) {
              $colorCode =  $listOfLebel['color_code'];
              $lebelName =  $listOfLebel['name'];
            }
            
            showTask($taskId,$taskName,$date,$priority,$lebelName,$colorCode);
             
          }
          if (!empty($overDueTask)) {
            ?>
          <h4>Over Due Task</h4>
          <?php
          }
        
          foreach($overDueTask as $row)
          {
            $taskId = $row['id'];
            $taskName = $row['name'];
            $priority = $row['priority'];
            $date = $row['date'];
            $lebelId = $row['lebel_id'];
            $lebelQuery = "SELECT * FROM lebels WHERE id = $lebelId";
            $listOfLebel = $connection->query($lebelQuery)->fetch_assoc();
            $colorCode = "#a0db8e";
            $lebelName = "Regular";


            if(!empty($listOfLebel)) {
              $colorCode =  $listOfLebel['color_code'];
              $lebelName =  $listOfLebel['name'];
            }
            showTask($taskId,$taskName,$date,$priority,$lebelName,$colorCode);
             
          }
          ?>
        </div>
      </form>

    <?php
  }
    ?>



</body>

</html>