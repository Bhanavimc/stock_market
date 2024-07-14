<?php
session_start();
require_once 'config.php';
require_once 'functions.php';
redirectIfNotLoggedIn();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $stock_id = $_POST['stock_id'];
    $transaction_type = $_POST['transaction_type'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $query = "INSERT INTO transactions (user_id, stock_id, transaction_type, quantity, price) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iisid", $user_id, $stock_id, $transaction_type, $quantity, $price);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Transaction added successfully!";
    } else {
        $_SESSION['message'] = "Failed to add transaction!";
    }

    $stmt->close();
    header("Location: transactions.php");
    exit();
}
?>
