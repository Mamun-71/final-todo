<?php
include 'database.php';


session_start();

if(!$_SESSION['userid'])
{
  header('location: index.php');
}

$userId  = $_SESSION['userid'];

if (isset($_GET['id'])) {
    $lebelId = ($_GET['id']);
    $deleteLebelQuery = "DELETE FROM lebels WHERE id=$lebelId";
    $runQuery = $connection->query($deleteLebelQuery );
}

header('location: showLebel.php');
