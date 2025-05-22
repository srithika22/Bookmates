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

// Get user ID from session
$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    echo "You must be logged in to proceed to checkout.";
    exit;
}

// Start a transaction to ensure atomicity (if multiple updates occur)
$conn->begin_transaction();

// Fetch all cart items for the user
$sql = "SELECT c.id, c.quantity, b.title, b.price, b.is_free FROM cart c JOIN books b ON c.book_id = b.id WHERE c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Your cart is empty. Please add items to your cart before proceeding.";
    exit;
}

$totalAmount = 0;

// Process each item in the cart
while ($row = $result->fetch_assoc()) {
    $price = $row['is_free'] == "yes" ? 0 : $row['price'];
    $totalAmount += $price * $row['quantity'];

    // Update book status or inventory logic here if needed (e.g., mark it as sold, update stock)
    // Example: Marking the book as purchased, this is optional
    // $updateBookSql = "UPDATE books SET status = 'sold' WHERE id = ?";
    // $updateStmt = $conn->prepare($updateBookSql);
    // $updateStmt->bind_param("i", $row['book_id']);
    // $updateStmt->execute();
}

// After processing all items, remove them from the cart
$deleteSql = "DELETE FROM cart WHERE user_id = ?";
$deleteStmt = $conn->prepare($deleteSql);
$deleteStmt->bind_param("i", $userId);
$deleteStmt->execute();

// Commit the transaction
$conn->commit();

// Close connections
$deleteStmt->close();
$stmt->close();
$conn->close();

// Redirect the user to a confirmation page or display a message
echo "<h1>Checkout Successful</h1>";
echo "<p>Your order has been placed successfully. You will receive a confirmation email shortly (if integrated).</p>";
echo "<a href='index.php'>Go back to homepage</a>";
?>
