<?php
session_start();
require_once 'header.php';
require_once 'functions.php';
redirectIfNotLoggedIn();
require_once 'config.php';

$user_id = $_SESSION['user_id'];

$query = "
    SELECT transactions.id, stocks.name, stocks.symbol, transactions.transaction_type, transactions.quantity, transactions.price, transactions.date
    FROM transactions
    JOIN stocks ON transactions.stock_id = stocks.id
    WHERE transactions.user_id = ?
    ORDER BY transactions.date DESC
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Transactions</h2>
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="alert">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Stock Name</th>
                    <th>Symbol</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['symbol']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['transaction_type']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                        echo "<td>$" . number_format($row['price'], 2) . "</td>";
                        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No transactions found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
require_once 'footer.php';
?>
