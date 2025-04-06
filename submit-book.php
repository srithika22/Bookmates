<?php
$servername = "sql107.infinityfree.com";
$username = "if0_38552695";
$password = "GyyZopL1Sa6"; // Empty password for XAMPP
$dbname = "if0_38552695_bookmates";
header('Content-Type: application/json'); // JSON response


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $category = trim($_POST['category']);
    $condition = trim($_POST['condition']);
    $isFree = trim($_POST['isFree']);
    $price = trim($_POST['price']);
    $address = trim($_POST['address']);
    $contact = trim($_POST['contact']);

    if (empty($title) || empty($author) || empty($category) || empty($condition) || empty($address) || empty($contact)) {
        echo json_encode(["success" => false, "message" => "All fields except price are required."]);
        exit;
    }

    $sql = "INSERT INTO books (title, author, category, book_condition, is_free, price, address, contact) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $title, $author, $category, $condition, $isFree, $price, $address, $contact);

    if ($stmt->execute()) {
      header("Content-Type: application/json");
      echo json_encode(["success" => true, "message" => "Book listed successfully."]);

      // Redirect to browse-books.html after sending JSON response
      header("Location: browse-books.html");
      exit;
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}



$conn->close();
?>
