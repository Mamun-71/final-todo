<?php
require_once 'database.php';

session_start();

if(!$_SESSION['userid'])
{
  header('location: index.php');
}
$userId = $_SESSION['userid'];

$lebelId = ($_GET['id']);
$query = "SELECT * FROM lebels WHERE id=$lebelId";
$runQuery = $connection->query($query);
$result = $runQuery->fetch_assoc();



$updateName = $result['name'];
$updateColorCode = $result['color_code'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
     body {
      padding: 0;
      margin: 0;
      background: url('background.jpg');
      background-size: cover;

      background-repeat: no-repeat;
    }
    </style>

</head>

<body>
<div class="container">
    <div class='row'>
        <div class='col-8 mx-auto mt-5'>
            <h2 class="display-4 mx-auto mt-2 text-center">Update Lebel</h2>

            <form  action="" method="post">
                <div class='form-group'>
                    <label for="lebelname">Lebel Name</label>
                     <input type="text" class="form-control" name="lebelname" placeholder="Lebele Name">
                </div>
                <div class='form-group'>
                    <label for="colorcode">Color Code</label>
                    <input type="text" class="form-control" name="colorcode" placeholder="Color Code">
                </div>
                <br>
                <div class='form-group'>
                    <input class="btn btn-warning btn-block" type="submit" name="update" value="Update">
                </div>
            </form>

        </div>
    </div>
</div>
</body>


<?php

if (isset($_POST['update'])) {


    If(!empty($_POST['lebelname'])) $updateName = $_POST['lebelname'];
    If(!empty($_POST['colorcode'])) $updateColorCode = $_POST['colorcode'];

    
    $query = "UPDATE lebels SET name = '$updateName', color_code = '$updateColorCode' WHERE id=$lebelId";
    $runQuery = $connection->query($query);

    header('location: showLebel.php');

}
?>