<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Database connection setup
$host = 'localhost';
$db = 'f1_shop';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders specific to the logged-in user
$user_id = $_SESSION['user_id'];
$orders = [];

$sql = "SELECT id, created_at, total_price FROM orders WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Page - F1 Merch Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>User Page</h1>
        <nav>
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li>User: <?php echo htmlspecialchars($_SESSION['username']); ?></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <h3>Your Orders:</h3>
        <?php if (!empty($orders)): ?>
            <ul>
                <?php foreach ($orders as $order): ?>
                    <li>
                        <strong>Order #<?php echo htmlspecialchars($order['id']); ?>:</strong> 
                        Placed on <?php echo htmlspecialchars($order['created_at']); ?>,
                        Total: $<?php echo number_format($order['total_price'], 2); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>You have no orders yet.</p>
        <?php endif; ?>
    </main>
    <footer>
    <p>&copy; 2024 F1 Merch Shop</p>
    <p>Follow us on:
        <a href="https://www.facebook.com/Formula1/" target="_blank">Facebook</a> |
        <a href="https://www.instagram.com/f1/" target="_blank">Instagram</a> |
        <a href="https://www.formula1.com" target="_blank">Official Site</a>
    </p>
</footer>

</body>
</html>
