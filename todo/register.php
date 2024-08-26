<?php
require_once 'db.php';

if (isset($_POST['register'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password hashing

    // Check if user already exists
    $check_user_query = "SELECT * FROM users WHERE email=?";
    $stmt = $dbcon->prepare($check_user_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "User already exists.";
    } else {
        // Insert new user
        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $dbcon->prepare($query);
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
            header("Location: login.php");
        } else {
            echo "Registration failed.";
        }
    }
}
?>

<!-- Registration form -->
<form method="POST" action="register.php">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="register">Register</button>
</form>
