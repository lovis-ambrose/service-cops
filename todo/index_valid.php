<?php
session_start();
require_once "db.php";

if (isset($_POST['addtask'])) {
    // Get the task name and description from the form
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];

    // Get the current date and time
    $added_time = date('Y-m-d H:i:s');

    // Insert the task into the database
    $query = "INSERT INTO task_table (task_name, task_description, added_tiime) VALUES (?, ?, ?)";
    $stmt = $dbcon->prepare($query);
    $stmt->bind_param("sss", $task_name, $task_description, $added_time);

    if ($stmt->execute()) {
        $_SESSION['task_add_success'] = "Task added successfully!";
    } else {
        $_SESSION['task_add_error'] = "Failed to add task. Please try again.";
    }

    // Redirect back to the main page
    header("Location: index.php");
    exit();
}
?>
