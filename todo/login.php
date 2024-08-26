<?php
session_start();
require_once 'db.php';

if (isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    // Check user credentials
    $query = "SELECT * FROM users WHERE email=?";
    $stmt = $dbcon->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php"); // Redirect to the main app
    } else {
        echo "Invalid email or password.";
    }
}
?>

<!-- Login form -->
<form method="POST" action="login.php">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
</form>
