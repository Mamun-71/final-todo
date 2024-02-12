<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>





<div class="container">
    <h1 class="text-white bg-dark page-header text-center my-3 py-4">Todo App</h1>
    <h3> Please Login!!!</h3>
</div>

<div class="container"> 
    <form action="login.php" method="post">

        <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" placeholder="Email">
        </div>

        <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <br>
        <button type="submit" class="btn btn-primary" name="login">Submit</button>
        <p>Don't have an account  <a href="signup.php">Sign Up</a></p>

    </form>

</div>

<?php


?>

</body>

</html>