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
<html>
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
  <title>Add Lebel</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

   <div class="navbar navbar-header container-fluid row">
      <a style ="font-size: 30px;" class="navbar-brand" href="home.php">Todo List</a>
      <a style ="font-size: 30px;" class="navbar-brand" href="showLebel.php">Lebels</a>
  </div>

  </div>

    <div class="container col-8">

      <h2 class="text-center md-2">Add Lebel</h2>
      <form action="" method="post">
      
         <div class="form-group">
         <label for="lebelname">Lebel Name</label>
         <input type="text" class="form-control" name="lebelname" placeholder="Lebel Name">
         </div>
         <br>

         <div class="form-group">
         <label for="colorcode">Color Code</label>
         <input type="text" class="form-control" name="colorcode" placeholder="Color Code">
         </div>
         <br>

        <input type="submit" class="btn btn-outline-success" name="lebel-submit" value="Submit">

      </form>
    </div>

</body>
</html>


<?php
if( isset($_POST['lebel-submit']) ){

  $lebelName = $_POST['lebelname'];
  $colorCode = $_POST['colorcode'];


  if(!empty($lebelName) && !empty($colorCode)){
    $lebelAddQuery = "INSERT INTO lebels (name, color_code, user_id)
    VALUES ('$lebelName', '$colorCode', '$userId')";
    $lebelInsert = $connection->query($lebelAddQuery);
    header('location: showLebel.php');
  }
  else
  {
     echo '<script>alert("All field should be filled up")</script>'; 
  }
}

?>