<?php
session_start();
require_once 'db.php';
$id = base64_decode($_GET['id']);

// Fetch the existing task and description from the database
$data = "SELECT * FROM task_table WHERE id=$id";
$data_from_db = $dbcon->query($data);
$f_result = $data_from_db->fetch_assoc();

if (isset($_POST['update'])) {
  $update_text = $_POST['update_text'];  // Task name
  $update_description = $_POST['update_description'];  // Task description

  // Update query to handle both name and description
  $update_query = "UPDATE task_table SET task_name='$update_text', task_description='$update_description' WHERE id=$id";
  $update_data = $dbcon->query($update_query);

  if ($update_data) {
    $_SESSION['update_success'] = "Task updated successfully!";
  }
  
  // Redirect back to the task list page after update
  header('location: index.php');
}

?>

<?php 
require_once 'header.php';
?>

<div class="container">
  <div class='row'>
    <div class='col-8 mx-auto mt-5'>
      <h2 class="display-4 mx-auto mt-2 text-center">Update Task</h2>
      <form class="" action="" method="post">
        <!-- Task Name -->
        <div class='form-group'>
          <input class="form-control form-control-lg" type="text" name="update_text" value="<?=$f_result['task_name'] ?>" required>
        </div>
        <!-- Task Description -->
        <div class='form-group'>
          <textarea class="form-control form-control-lg" name="update_description" placeholder="Update task description" required><?=$f_result['task_description']?></textarea>
        </div>
        <!-- Submit Button -->
        <div class='form-group'>
          <input class="btn btn-warning btn-block" type="submit" name="update" value="Update">
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
