<?php
session_start();
require_once 'db.php';

$id = base64_decode($_GET['id']);
$user_id = $_SESSION['user_id']; // Get the logged-in user's ID

// Check if the task belongs to the user
$query = "DELETE FROM task_table WHERE id=? AND user_id=?";
$stmt = $dbcon->prepare($query);
$stmt->bind_param("ii", $id, $user_id);
if ($stmt->execute()) {
    $_SESSION['delete_success'] = "Task deleted successfully!";
} else {
    $_SESSION['delete_error'] = "Failed to delete task.";
}
header('Location: index.php');
exit();
?>
