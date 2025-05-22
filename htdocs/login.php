<?php
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

// Get email and password from POST request
$email = $_POST['email'];
$password = $_POST['password'];

// Sanitize inputs
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

// Prepare SQL statement to avoid SQL injection
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    // Verify the password using password_verify()
    if (password_verify($password, $user['password'])) {
        // Successful login, start session
        session_start();
        $_SESSION['user_id'] = $user['id']; // Store user ID in session
        header("Location: browse-books.html");
        exit(); // Always use exit() after header redirect
    } else {
        // Invalid password
        header("Location: Login.html?error=wrong");
        exit();
    }
} else {
    // User not found
    header("Location: Login.html?error=USER");
    exit();
}


// Close connection
$stmt->close();
$conn->close();
?>
