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
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(403); // Forbidden
    echo json_encode(['success' => false, 'message' => 'You must be logged in to delete a book.']);
    exit;
}

// Get book ID from the GET request
$book_id = $_GET['id'] ?? null;

// Validate book ID
if (!is_numeric($book_id)) {
    http_response_code(400); // Bad Request
    echo json_encode(['success' => false, 'message' => 'Invalid book ID.']);
    exit;
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Prepare SQL statement to delete the book
$sql = "DELETE FROM books WHERE id = ? AND user_id = ?";

// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $book_id, $user_id);

// Execute the statement
if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        // Book deleted successfully
        echo json_encode(['success' => true, 'message' => 'Book deleted successfully.']);
    } else {
        // Book not found or user not authorized
        http_response_code(403); // Forbidden
        echo json_encode(['success' => false, 'message' => 'You are not authorized to delete this book or book not found.']);
    }
} else {
    // Failed to delete book
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to delete book: ' . $stmt->error]);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
