<?php
session_start();
require_once 'header.php';
require_once 'functions.php';
redirectIfNotLoggedIn();
require_once 'config.php';

$user_id = $_SESSION['user_id'];

// Fetch watchlist data
$query = "
    SELECT stocks.name
    FROM watchlist
    JOIN stocks ON watchlist.stock_id = stocks.id
    WHERE watchlist.user_id = ?
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
    <title>Watchlist</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Watchlist</h2>
        <table>
            <thead>
                <tr>
                    <th>Stock Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='1'>No stocks in watchlist</td></tr>";
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
