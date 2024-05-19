<?php
session_start();

// Initialize cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
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

// Add product to the cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);

    if (!in_array($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $product_id;
    }
}

// Remove product from the cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_id'])) {
    $remove_id = intval($_POST['remove_id']);

    // Remove item by filtering out the specific ID
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($remove_id) {
        return $item != $remove_id;
    });
}

// Place order by inserting into orders table and clearing the cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order']) && isset($_SESSION['user_id'])) {
    $total_price = 0;
    $ids = implode(',', array_map('intval', $_SESSION['cart']));
    $sql = "SELECT price FROM products WHERE id IN ($ids)";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $total_price += $row['price'];
    }

    // Insert new order
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price) VALUES (?, ?)");
    $stmt->bind_param("id", $user_id, $total_price);
    $stmt->execute();
    $stmt->close();

    $_SESSION['cart'] = [];
    $_SESSION['message'] = "Order placed successfully!";
    header("Location: shop.php");
    exit();
}

// Retrieve items in the cart
$cart_items = [];
$total_price = 0;
if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_map('intval', $_SESSION['cart']));
    $sql = "SELECT id, name, price, description FROM products WHERE id IN ($ids)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cart_items[] = $row;
            $total_price += $row['price'];
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart - F1 Merch Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Shopping Cart</h1>
        <nav>
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="cart.php">Cart</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="user.php">User Page</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li>User: <?php echo htmlspecialchars($_SESSION['username']); ?></li>
                <?php else: ?>
                    <li><a href="register.html">Register</a></li>
                    <li><a href="login.html">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <?php if (!empty($cart_items)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td>$<?php echo htmlspecialchars($item['price']); ?></td>
                        <td><?php echo htmlspecialchars($item['description']); ?></td>
                        <td>
                            <form action="cart.php" method="post">
                                <input type='hidden' name='remove_id' value='<?php echo htmlspecialchars($item['id']); ?>'>
                                <input type='submit' value='Remove'>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan='3'><strong>Total:</strong></td>
                        <td><strong>$<?php echo number_format($total_price, 2); ?></strong></td>
                    </tr>
                </tfoot>
            </table>
            <form action="cart.php" method="post">
                <input type="hidden" name="place_order" value="1">
                <input type="submit" value="Place Order">
            </form>
        <?php else: ?>
            <p>Your cart is empty. Go back to the <a href="shop.php">shop</a> to add items.</p>
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
