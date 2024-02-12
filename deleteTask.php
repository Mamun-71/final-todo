<?php
require_once "database.php";
session_start();
if(!$_SESSION['userid'])
{
  header('location: index.php');
}


if(isset($_POST['bulk_delete_submit'])){ 

    if(!empty($_POST['checked_id'])){ 
   
        $idStr = implode(',', $_POST['checked_id']); 
         
      
        $delete = $connection->query("DELETE FROM tasks WHERE id IN ($idStr)"); 
         
    
        if($delete){ 
            $statusMsg = 'Selected users have been deleted successfully.'; 
        }else{ 
            $statusMsg = 'Some problem occurred, please try again.'; 
        } 
    }else{ 
        $statusMsg = 'Select at least 1 record to delete.'; 
    } 
} 



if (isset($_GET['id'])) {
    $id = ($_GET['id']);
    $delete_query = "DELETE FROM tasks WHERE id=$id";
    $delete_query;
    $run_query = $connection->query($delete_query);
}

header('location: home.php');
