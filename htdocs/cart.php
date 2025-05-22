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
    echo "You must be logged in to view the cart.";
    exit;
}

// Fetch cart items
$sql = "SELECT c.id, c.quantity, b.title, b.author, b.price, b.is_free FROM cart c JOIN books b ON c.book_id = b.id WHERE c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<h1>Your Cart</h1>";
    echo "<table border='1'>
            <tr>
                <th>Book Title</th>
                <th>Author</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        $price = $row['is_free'] == "yes" ? "FREE" : "$" . number_format($row['price'], 2);
        echo "<tr>
                <td>{$row['title']}</td>
                <td>{$row['author']}</td>
                <td>{$row['quantity']}</td>
                <td>{$price}</td>
                <td><button onclick='removeFromCart({$row['id']})'>Remove</button></td>
            </tr>";
    }

    echo "</table>";
    echo "<button onclick='checkout()'>Proceed to Checkout</button>";
} else {
    echo "<p>Your cart is empty.</p>";
}

// Close connection
$stmt->close();
$conn->close();
?>

<script>
function removeFromCart(cartItemId) {
    if (confirm('Are you sure you want to remove this item from your cart?')) {
        fetch(`remove-from-cart.php?id=${cartItemId}`, {
            method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to remove item from cart.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function checkout() {
    // Proceed to checkout process, e.g., go to checkout page
    window.location.href = 'checkout.php'; // Modify this URL as per your checkout page
}
</script>
