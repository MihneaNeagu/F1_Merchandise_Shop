<?php
session_start();

// Database connection
$host = 'localhost';
$db = 'f1_shop';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login process
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch stored user details
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['message'] = "Welcome back, $username!";
        } else {
            $_SESSION['message'] = "Invalid password. Please try again.";
        }
    } else {
        $_SESSION['message'] = "Invalid username. Please try again.";
    }

    $stmt->close();
}

$conn->close();

// Redirect to shop.php
header("Location: shop.php");
exit();
?>
