<?php
include 'database.php';

session_start();

if(!$_SESSION['userid'])
{
  header('location: index.php');
}
$userId = $_SESSION['userid'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    body {
      padding: 0;
      margin: 0;
      background: url('background.jpg');
      background-size: cover;

      background-repeat: no-repeat;
    }
  </style>
  <title>Document</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

  <div class="navbar navbar-header container-fluid">
        <a style ="font-size: 40px;" class="navbar-brand" href="home.php">Todo List</a>
  </div>

  <div class="container col-8"> 
    <form action="" method="post">

        <div class="form-group">
        <label for="Task Name">Task Name</label>
        <input type="text" class="form-control" name="taskname" placeholder="Task Name">
        </div>

        <div class="from-group">
          <label for="priority">Priority</label>
          <select class="form-select" name="priority">   
              <option value="High">High</option>
              <option value="Medium">Medium</option>
              <option value="Low">Low</option>
          </select>
        </div>
        

        <div class="from-group">
        <label for="Date">Due Date</label><br>
        <input type="date" name="date" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31">
        </div>

    

        <div class="from-group">
          <label for="lebels">Choose a lebel:</label>
          <select class="form-select" name="lebel">
            <?php
                $lebelQuery = "SELECT * FROM lebels WHERE user_id=$userId";
                $totalLebel = $connection->query($lebelQuery);

               foreach ($totalLebel as $row)
               {
                  $lebelName = $row['name'];
                  $lebelId =  $row['id'];
                  ?>
                  <option value="<?php echo $lebelId; ?>">  <?php echo $lebelName;?> </option>
                  <?php
               }
            ?>
          </select>
        </div>
        <br>
        <input type="submit" class="btn btn-outline-success" name="task-submit" value="Submit">

    </form>
  </div>
</body>
</html>

<?php

if(isset($_POST['task-submit'])){

  $taskName = $_POST['taskname'];
  $priority = $_POST['priority'];
  $date = $_POST['date'];
  $lebelId = $_POST['lebel'];


  if(!empty($taskName) && !empty($priority) && !empty($date)){

    $taskAddQuery = "INSERT INTO tasks (name, user_id, date, lebel_id, priority)
    VALUES ('$taskName', '$userId', '$date', '$lebelId','$priority')";
    $taskInsert = $connection->query($taskAddQuery);
    header('location: home.php');

  }
  else
  {
     echo '<script>alert("All field should be fill up")</script>'; 
  }

  //  header('location: home.php');
}

?>