<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session if it's not already started
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Market</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <h1>Welcome to Stock Market</h1>
        <nav>
            <ul>
                <li><a href="stocks.php">Stocks</a></li>
                <li><a href="transactions.php">Transactions</a></li>
                <li><a href="watchlist.php">Watchlist</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
