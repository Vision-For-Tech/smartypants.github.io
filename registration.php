<?php

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";


$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo('Hello Mysql from '. $servername);
}

// Process registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_client = $_POST["username"];
    $password_client = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash password

    // Prepare SQL statement
    // Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO user_registration (username, password) VALUES (?, ?)");

if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("ss", $username_client, $password_client);

// Execute SQL statement
if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error executing statement: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
exit();
}
?>

