<?php
session_start();
require_once 'functions.php';
redirectIfNotLoggedIn();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $stock_id = $_POST['stock_id'];

    // Check if the stock already exists in the watchlist for the user
    $query = "SELECT id FROM watchlist WHERE user_id = ? AND stock_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $stock_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Stock is already in your watchlist.";
    } else {
        // Add the stock to the watchlist
        $insert_query = "INSERT INTO watchlist (user_id, stock_id) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("ii", $user_id, $stock_id);
        
        if ($insert_stmt->execute()) {
            header("Location: watchlist.php");
            exit();
        } else {
            echo "Error adding stock to watchlist: " . $conn->error;
        }
    }

    $stmt->close();
    $insert_stmt->close();
}

$conn->close();
?>
