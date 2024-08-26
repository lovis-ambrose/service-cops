<?php
session_start();
require_once "header.php"; // Ensure this file sets up your header, including necessary CSS and JS.

// Check if ID is provided and valid
if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit();
}

$task_id = base64_decode($_GET['id']);

// Include the database connection
require_once "db.php";

// Fetch the task details
$query = "SELECT * FROM task_table WHERE id = ?";
$stmt = $dbcon->prepare($query);
$stmt->bind_param("i", $task_id);
$stmt->execute();
$result = $stmt->get_result();
$task = $result->fetch_assoc();

if (!$task) {
    echo "Task not found.";
    exit();
}

// Get the date and time
$temp_date_time = explode(' ', $task['added_tiime']);
$date = $temp_date_time[0];
$time = $temp_date_time[1];
?>

<div class="container">
  <div class="row">
    <div class="col-8 m-auto">
      <h2 class="display-4 text-center">View Task</h2>
      <div class="mt-4">
        <p><strong>Task:</strong> <?=$task['task_name']?></p>
        <p><strong>Description:</strong> <?=$task['task_description']?></p> <!-- Added Description here -->
        <p><strong>Date Added:</strong> <?=$date?></p>
        <p><strong>Time Added:</strong> <?=$time?></p>
      </div>
      <div class="text-center mt-4">
        <a href="index.php" class="btn btn-primary">Back to Task List</a>
      </div>
    </div>
  </div>
</div>

</body>
</html>
