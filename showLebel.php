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

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <!-- Show all lebels -->
    <?php

     $showLebelQuery =  "SELECT * FROM lebels WHERE user_id = $userId";
     $result = $connection->query($showLebelQuery);
    ?>

    <div class="navbar navbar-header container-fluid">
        <a style ="font-size: 40px;" class="navbar-brand" href="home.php">Todo List</a>
    </div>

   

    <div class="container my-3 text-center">
        <a  style="width:66%" class="btn btn-primary btn-lg btn-block"href="addLebel.php" role="button">Add Lebel</a>
        <h2>Lebel List</h2>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-8 m-auto">

                <table class="table table-sm table-borderless table-striped text-center mx-auto
                
                ">
                    <thead class="bg-dark text-white ">
                        <tr>
                            <th>Serial</th>
                            <th>Lebel Name</th>
                            <th>Color Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <?php


                    if ($result->num_rows != 0) {

                        $serial = 0;

                        foreach ($result as $row) {

                            $lebelName = $row['name'];
                            $colorCode = $row['color_code'];
                            $serial++;
                    ?>

                            <tr>
                                <td> <?php echo $serial ?> </td>
                                <td> <?php echo $lebelName ?> </td>
                                <td> <?php echo $colorCode ?> </td>

                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-md btn-warning" href="updateLebel.php?id=<?php echo ($row['id']); ?>">Update</a>
                                        <a class="btn btn-md btn-danger" href="deleteLebel.php?id=<?php echo ($row['id']); ?>" onclick="return confirm('Are you sure?')">Delete</a>
                                    </div>
                                </td>

                            </tr>

                        <?php


                        }
                    }
                    else {
                        ?>

                        <tr>
                            <td colspan="20" class="text-center display-4">No Lebles</td>
                        </tr>

                    <?php
                    }
                    ?>

                </table>

            </div>
        </div>
    </div>


</body>
</html>