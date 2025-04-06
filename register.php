<?php
$servername = "sql107.infinityfree.com";
$username = "if0_38552695";
$password = "GyyZopL1Sa6";
$dbname = "if0_38552695_bookmates";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted and required fields are provided
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['username'];  // Assuming 'username' is the field name in the form
    $userEmail = $_POST['email'];    // Assuming 'email' is the field name in the form
    $userPassword = $_POST['password'];  // Assuming 'password' is the field name in the form

    // Ensure that the necessary fields are not empty
    if (!empty($userName) && !empty($userEmail) && !empty($userPassword)) {
        // Hash the password for security
        $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$userName', '$userEmail', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to index.html after successful sign-up
             header("Location: Login.html");
            exit();  // Stop further execution
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "All fields are required.";
    }
}

// Close the database connection
$conn->close();
?>
