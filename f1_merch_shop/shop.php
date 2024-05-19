<?php
session_start();

// Database connection setup
$host = 'localhost';
$db = 'f1_shop';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling the search keyword and team filtering
$search_keyword = isset($_GET['search']) ? $_GET['search'] : '';
$team_filter = isset($_GET['team']) ? $_GET['team'] : '';

// Prepare SQL query
$sql = "SELECT id, name, price, description, image_url, team FROM products WHERE (name LIKE ? OR description LIKE ?) AND (team LIKE ? OR ? = '')";
$stmt = $conn->prepare($sql);
$like_keyword = '%' . $search_keyword . '%';
$like_team = $team_filter ? $team_filter : '%';
$stmt->bind_param('ssss', $like_keyword, $like_keyword, $like_team, $like_team);
$stmt->execute();
$result = $stmt->get_result();
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>F1 Merch Shop - Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>F1 Merchandise Shop
            <img src="images/f1_logo.jpg" alt="F1 Logo" style="width: 50px;">
        </h1>
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
        <div class="search-filter">
            <form id="filterForm" action="shop.php" method="get">
                <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($search_keyword); ?>" placeholder="Search for products...">
                <label for="team">Choose Team:</label>
                <select name="team" id="team">
                    <option value="">Select Team</option>
                    <option value="redbull" <?php echo $team_filter == 'redbull' ? 'selected' : ''; ?>>Red Bull Racing</option>
                    <option value="ferrari" <?php echo $team_filter == 'ferrari' ? 'selected' : ''; ?>>Scuderia Ferrari</option>
                    <option value="mercedes" <?php echo $team_filter == 'mercedes' ? 'selected' : ''; ?>>Mercedes-AMG Petronas</option>
                    <option value="mclaren" <?php echo $team_filter == 'mclaren' ? 'selected' : ''; ?>>McLaren</option>
                    <option value="aston_martin" <?php echo $team_filter == 'aston_martin' ? 'selected' : ''; ?>>Aston Martin</option>
                </select>
                <button type="submit">Search</button>
            </form>
        </div>
        <section class="<?php echo htmlspecialchars($team_filter); ?>">
            <h2>Our Products</h2>
            <div class="products-container">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class='product-card'>
                            <img src='<?php echo htmlspecialchars($product['image_url']); ?>' alt='<?php echo htmlspecialchars($product['name']); ?>' class='product-image' onclick='showImageModal(this)'>
                            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                            <p><?php echo htmlspecialchars($product['description']); ?></p>
                            <p class='price'>$<?php echo htmlspecialchars($product['price']); ?></p>
                            <form action='cart.php' method='post'>
                                <input type='hidden' name='product_id' value='<?php echo htmlspecialchars($product['id']); ?>'>
                                <input type='submit' value='Add to Cart'>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No products available.</p>
                <?php endif; ?>
            </div>
        </section>

       <!-- Image Modal HTML Structure -->
<div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="imgModal">
    <div id="caption"></div>
</div>

    </main>
    <footer>
        <p>&copy; 2024 F1 Merch Shop</p>
        <p>Contact us at: <a href="mailto:support@f1merchshop.com">support@f1merchshop.com</a> | Call us: 1-800-123-4567</p>
        <p>Follow us on:
            <a href="https://www.facebook.com/Formula1/" target="_blank">Facebook</a> |
            <a href="https://www.instagram.com/f1/" target="_blank">Instagram</a> |
            <a href="https://www.formula1.com" target="_blank">Official Site</a>
        </p>
    </footer>
    <script src="validation.js"></script>
</body>
</html>
