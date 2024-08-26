<?php
session_start();
require_once 'db.php';

if (isset($_POST['addtask'])) {
    $task_name = htmlspecialchars($_POST['task_name']);
    $task_description = htmlspecialchars($_POST['task_description']);
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID

    // Insert the new task into the database
    $query = "INSERT INTO task_table (task_name, task_description, user_id) VALUES (?, ?, ?)";
    $stmt = $dbcon->prepare($query);
    $stmt->bind_param("ssi", $task_name, $task_description, $user_id);
    if ($stmt->execute()) {
        $_SESSION['task_success'] = "Task added successfully!";
    } else {
        $_SESSION['task_error'] = "Failed to add task.";
    }
    header("Location: index.php");
    exit();
}
?>
