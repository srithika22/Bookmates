<?php
session_start(); // Start the session

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

// Get the current user's ID from the session
$loggedInUserID = $_SESSION['user_id'] ?? null;

// Get the selected genre and search term from the URL (if any)
$selectedGenre = $_GET['genre'] ?? '';
$searchTerm = $_GET['search'] ?? '';

$conditions = [];
if ($selectedGenre) {
    $safeGenre = $conn->real_escape_string($selectedGenre);
    $conditions[] = "category = '$safeGenre'";
}

if ($searchTerm) {
    $safeSearch = $conn->real_escape_string($searchTerm);
    $conditions[] = "(title LIKE '%$safeSearch%' OR author LIKE '%$safeSearch%')";
}

$whereClause = count($conditions) > 0 ? 'WHERE ' . implode(' AND ', $conditions) : '';

// Fetch books based on conditions
$sql = "SELECT id, user_id, title, author, category, book_condition, is_free, price, contact FROM books $whereClause ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display books
    while ($row = $result->fetch_assoc()) {
        $price = $row["is_free"] === "yes" ? "FREE" : "$" . number_format($row["price"], 2);
        $deleteButton = '';

        // Check if the current user is the owner of the book
        if ($loggedInUserID == $row['user_id']) {
            $deleteButton = "<button onclick=\"deleteBook({$row['id']})\">Delete</button>";
        }

        // Output book details with proper escaping
        echo "<div class='book-item' id='book-" . htmlspecialchars($row['id']) . "'>
                <h2>" . htmlspecialchars($row['title']) . "</h2>
                <p><strong>Author:</strong> <span class='author'>" . htmlspecialchars($row['author']) . "</span></p>
                <p><strong>Category:</strong> <span class='genre'>" . htmlspecialchars($row['category']) . "</span></p>
                <p><strong>Condition:</strong> " . htmlspecialchars($row['book_condition']) . "</p>
                <p class='price'><strong>Price:</strong> {$price}</p>
                <p class='contact'><strong>Contact:</strong> " . htmlspecialchars($row['contact']) . "</p>
  
                {$deleteButton}
            </div>";
    }
    while ($row = $result->fetch_assoc()) {
    $bookId = htmlspecialchars($row['id']);
    $title = htmlspecialchars($row['title']);
    $author = htmlspecialchars($row['author']);
    $genre = htmlspecialchars($row['category']);
    $condition = htmlspecialchars($row['book_condition']);
    $isFree = $row['is_free'] === 'yes' ? 'Free' : 'Paid';
    $price = $row['price'] > 0 ? '$' . number_format($row['price'], 2) : '';

    $imageFile = htmlspecialchars($row['image']);  // Assuming this column stores filename like book1.jpg
    $imagePath = "images/" . $imageFile;

    echo "<div class='book-item' data-book-id='$bookId'>
        <img src='$imagePath' alt='Book Cover for $title' style='width:150px; height:auto; margin-bottom:10px;' />
        <h2>$title</h2>
        <p class='author'>$author</p>
        <p class='genre'>$genre</p>
        <p>Condition: $condition</p>
        <p>Price: $isFree $price</p>
        <button onclick='addToCart($bookId)'>Add to Cart</button>";

    // Delete button code (if logged in & owner) here...

    echo "</div>";
}

} else {
    echo "<p>No books available at the moment.</p>";
}

// Close connection
$conn->close();
?>