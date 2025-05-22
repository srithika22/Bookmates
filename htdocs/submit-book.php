<?php
session_start(); // Start the session

// Database connection details (Make sure these are correct)
$servername = "sql107.infinityfree.com";
$username = "if0_38552695";
$password = "GyyZopL1Sa6";
$dbname = "if0_38552695_bookmates";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(403); // Forbidden
    echo json_encode(['success' => false, 'message' => 'You must be logged in to post a book.']);
    exit;
}

// Validate input data (same validation as before)
$required = ['title', 'author', 'category', 'condition', 'address', 'contact', 'is_free'];
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        http_response_code(400); // Bad Request
        echo json_encode(['success' => false, 'message' => "$field is required"]);
        exit;
    }
}

// Sanitize data
$title = $conn->real_escape_string($_POST['title']);
$author = $conn->real_escape_string($_POST['author']);
$category = $conn->real_escape_string($_POST['category']);
$condition = $conn->real_escape_string($_POST['condition']);
$address = $conn->real_escape_string($_POST['address']);
$contact = $conn->real_escape_string($_POST['contact']);
$is_free = $_POST['is_free']; // No need to sanitize radio input
$price = null;

if ($is_free === 'no') {
    if (!isset($_POST['price']) || !is_numeric($_POST['price']) || $_POST['price'] <= 0) {
        http_response_code(400); // Bad Request
        echo json_encode(['success' => false, 'message' => 'Price is required and must be a positive number for non-free books.']);
        exit;
    }
    $price = (float)$_POST['price'];
}

// Get user ID from the session
$user_id = $_SESSION['user_id'];

// Prepare SQL statement (including user_id)
$sql = "INSERT INTO books (user_id, title, author, category, book_condition, is_free, price, contact, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("isssssdds", $user_id, $title, $author, $category, $condition, $is_free, $price, $contact, $address);

// Execute the statement
if ($stmt->execute()) {
    // Redirect to thank-you page
    //echo json_encode(['success' => true, 'message' => 'Book posted successfully!']);
    header("Location: browse-books.html");
} else {
    // Failed to insert book
    http_response_code(500); // Internal Server Error
    echo json_encode(['success' => false, 'message' => 'Failed to post book: ' . $stmt->error]);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
