<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $symbol = $_POST['symbol'];
    $price = $_POST['price'];
    $change = $_POST['change'];
    $volume = $_POST['volume'];

    $sql = "INSERT INTO stocks (name, symbol, price, change, volume) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssddi", $name, $symbol, $price, $change, $volume);

    if ($stmt->execute()) {
        echo "New stock added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stock</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <h1>Add New Stock</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="stocks.php">Stocks</a></li>
            <li><a href="transactions.php">Transactions</a></li>
            <li><a href="add_stock.php">Add Stock</a></li>
        </ul>
    </nav>
    <div class="container">
        <form action="add_stock.php" method="post">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="symbol">Symbol:</label>
                <input type="text" id="symbol" name="symbol" required>
            </div>
            <div>                           
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>
            <div>
                <label for="change">Change:</label>
                <input type="number" id="change" name="change" step="0.01" required>
            </div>
            <div>
                <label for="volume">Volume:</label>
                <input type="number" id="volume" name="volume" required>
            </div>
            <div>
                <button type="submit">Add Stock</button>
            </div>
        </form>
    </div>
</body>
</html>
