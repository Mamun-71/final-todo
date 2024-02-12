<?php

include 'database.php';

if (isset($_POST['login'])) {
    $EMAIL = $_POST['email'];
    $PASSWORD = $_POST['password'];

    $userQuery = "SELECT * FROM users
    WHERE email='$EMAIL' AND password='$PASSWORD' ";

    $result = $connection->query($userQuery);
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);

    

    if ($count == 1) {

        session_start();
        $_SESSION['userid'] = $row['id'];
        
        header("Location: home.php");

    }
    else
    {
        header('location: index.php');
    }
}
else
{
    header('location: index.php');
}

