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

// Fetch cart items for checkout
$sql = "SELECT c.id, c.quantity, b.title, b.author, b.price, b.is_free 
        FROM cart c 
        JOIN books b ON c.book_id = b.id 
        WHERE c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<h1>Your Cart for Checkout</h1>";
    echo "<table border='1'>
            <tr>
                <th>Book Title</th>
                <th>Author</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>";
    
    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $price = $row['is_free'] == "yes" ? 0 : $row['price'];
        $total += $price * $row['quantity'];
        echo "<tr>
                <td>{$row['title']}</td>
                <td>{$row['author']}</td>
                <td>{$row['quantity']}</td>
                <td>$" . number_format($price, 2) . "</td>
            </tr>";
    }

    echo "</table>";
    echo "<h3>Total: $" . number_format($total, 2) . "</h3>";
    echo "<button onclick='finalizeCheckout()'>Finalize Checkout</button>";
} else {
    echo "<p>Your cart is empty.</p>";
}

// Close connection
$stmt->close();
$conn->close();
?>

<script>
function finalizeCheckout() {
    // Implement your checkout process (e.g., payment gateway, order review)
    alert('Proceeding to finalize your checkout.');
    // Example: Redirect to an order confirmation page
    window.location.href = 'thank-you.html'; // Change to your actual confirmation page
}
</script>
