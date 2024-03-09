<?php
session_start();

$servername = 'localhost';
$username = 'root';
$password = "";
$database = "users";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare SQL statement to fetch user details
    $sql = "SELECT * FROM user_registration WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Check if a user with the given username exists
        if (mysqli_num_rows($result) == 1) {
            // Fetch user details
            $row = mysqli_fetch_assoc($result);
            // Verify password
            if (password_verify($password, $row['password'])) {
                // Password is correct, set session variable
                $_SESSION["username"] = $username;
                // Redirect to dashboard or homepage
                header("Location: profile.php");
                exit;
            } else {
                // Display error message for incorrect password
                echo "Invalid password.";
            }
        } else {
            // Display error message for invalid username
            echo "Invalid username.";
        }
    } else {
        // Display error message for database query failure
        echo "Error: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
