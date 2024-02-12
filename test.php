<?php
require_once 'database.php';
$id = ($_GET['id']);
$data = "SELECT * FROM tasks WHERE task_id=$task_id";
$data_from_db = $connection->query($data);
$fResult = $data_from_db->fetch_assoc();

if (isset($_POST['update'])) {
    $update_text = $_POST['update_text'];
    $update_query = "UPDATE tasks SET task_name='$update_text' WHERE task_id=$task_id";
    $update_date = $connection->query($update_query);
    header("Location: home.php"); 
}

?>

<div class="container">
    <div class='row'>
        <div class='col-8 mx-auto mt-5'>
            <h2 class="display-4 mx-auto mt-2 text-center">Update Task</h2>
            <form class="" action="" method="post">
                <div class='form-group'>
                    <input class="form-control form-control-lg" type="text" name="update_text" value="<?= $f_result['task_name'] ?>">
                </div>
                <div class='form-group'>
                    <input class="btn btn-warning btn-block" type="submit" name="update" value="update">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once 'home.php';
?>