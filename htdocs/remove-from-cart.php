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

// Check if user is logged in
$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to remove an item.']);
    exit;
}

// Get the cart item ID from GET request
$cartItemId = $_GET['id'] ?? null;
if (!is_numeric($cartItemId)) {
    echo json_encode(['success' => false, 'message' => 'Invalid cart item ID.']);
    exit;
}

// Prepare SQL to remove item from the cart
$sql = "DELETE FROM cart WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $cartItemId, $userId);

// Execute query
if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Item removed from cart']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Item not found or you are not authorized']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to remove item from cart: ' . $stmt->error]);
}

// Close connection
$stmt->close();
$conn->close();
?>
