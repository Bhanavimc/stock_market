<?php
session_start();
require_once 'header.php';
require_once 'functions.php';
redirectIfNotLoggedIn();
require_once 'config.php';

$query = "SELECT id, name, symbol, price, `change`, volume FROM stocks";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stocks</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Stocks</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Symbol</th>
                    <th>Price</th>
                    <th>Change</th>
                    <th>Volume</th>
                    <th>Action</th>
                    <th>Add to Watchlist</th> <!-- Added column for Watchlist button -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['symbol']) . "</td>";
                        echo "<td>$" . number_format($row['price'], 2) . "</td>";
                        echo "<td>" . htmlspecialchars($row['change']) . "</td>";
                        echo "<td>" . number_format($row['volume']) . "</td>";
                        echo '<td>
                                <form action="add_transaction.php" method="post">
                                    <input type="hidden" name="stock_id" value="' . $row['id'] . '">
                                    <input type="number" name="quantity" placeholder="Quantity" required>
                                    <input type="hidden" name="price" value="' . $row['price'] . '">
                                    <select name="transaction_type" required>
                                        <option value="buy">Buy</option>
                                        <option value="sell">Sell</option>
                                    </select>
                                    <button type="submit">Submit</button>
                                </form>
                              </td>';
                              
                        // Watchlist button form
                        echo '<td>
                                <form action="add_to_watchlist.php" method="post">
                                    <input type="hidden" name="stock_id" value="' . $row['id'] . '">
                                    <button type="submit">Add to Watchlist</button>
                                </form>
                              </td>';
                              
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No stocks found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
require_once 'footer.php';
?>
