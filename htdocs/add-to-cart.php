<?php
session_start();

// Database connection details
$servername = "sql107.infinityfree.com";
$username = "if0_38552695";
$password = "GyyZopL1Sa6";
$dbname = "if0_38552695_bookmates";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get book data from POST request
$bookId = $_POST['bookId'];
$userId = $_SESSION['user_id'];  // Assuming the user is logged in and user_id is stored in session
$quantity = $_POST['quantity'] ?? 1; // Default to 1 if no quantity is provided

// Check if the book already exists in the cart for the user
$sql = "SELECT * FROM cart WHERE user_id = ? AND book_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $userId, $bookId);
$stmt->execute();
$result = $stmt->get_result();

// If the book exists, update the quantity
if ($result->num_rows > 0) {
    $sql = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $quantity, $userId, $bookId);
    $stmt->execute();
} else {
    // Otherwise, insert the book into the cart
    $sql = "INSERT INTO cart (user_id, book_id, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $userId, $bookId, $quantity);
    $stmt->execute();
}

// Fetch the updated cart count
$sql = "SELECT COUNT(*) as cart_count FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($cartCount);
$stmt->fetch();

// Respond with success and the updated cart count
echo json_encode([
    'success' => true,
    'message' => 'Book added to cart',
    'cartCount' => $cartCount
]);

// Close connection
$stmt->close();
$conn->close();
?>
