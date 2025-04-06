<?php
// Database connection details
$servername = "sql107.infinityfree.com";
$username = "if0_38552695";
$password = "GyyZopL1Sa6"; // Database password
$dbname = "if0_38552695_bookmates";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch books
$sql = "SELECT title, author, category, book_condition, is_free, price, contact FROM books ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $price = $row["is_free"] === "Yes" ? "FREE" : "$" . number_format($row["price"], 2);
        echo "<div class='book-card'>
                <h3>{$row['title']}</h3>
                <p><strong>Author:</strong> {$row['author']}</p>
                <p><strong>Category:</strong> {$row['category']}</p>
                <p><strong>Condition:</strong> {$row['book_condition']}</p>
                <p class='price'><strong>Price:</strong> {$price}</p>
                <p class='contact'><strong>Contact:</strong> {$row['contact']}</p>
              </div>";
    }
} else {
    echo "<p>No books available at the moment.</p>";
}

// Close connection
$conn->close();
?>
