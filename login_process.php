<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check user credentials
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login successful
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        header("Location: stocks.php"); // Redirect to stocks page after login
        exit();
    } else {
        // Login failed
        echo "Invalid username or password.";
    }
}

$conn->close();
?>
