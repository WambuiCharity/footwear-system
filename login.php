<?php
// Connect to MySQL server
require "db.php";

session_start(); // Start the session

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to your MySQL database
    $conn = new mysqli("sql8.freesqldatabase.com", "sql8654148", "KgPdFcec6B", "sql8654148");

    // Check for database connection errors
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Function to sanitize input and prevent SQL injection
    function clean($str, $conn) {
        $str = trim($str);
        return $conn->real_escape_string($str);
    }

    // Sanitize the POST values
    $login = clean($_POST['user'], $conn);
    $password = clean($_POST['password'], $conn);

    // Create and execute the query
    $qry = "SELECT * FROM users WHERE username='$login' AND password='$password'";
    $result = $conn->query($qry);

    if ($result) {
        if ($result->num_rows > 0) {
            // Login Successful
            $member = $result->fetch_assoc();
            $_SESSION['user_id'] = $member['id']; // You may store user ID in the session for later use
            $conn->close();

            header("location: productsuser.php");
            exit();
        } else {
            // Login failed
            $conn->close();
            header("location: products.php");
            exit();
        }
    } else {
        // Query failed
        $conn->close();
        die("Query failed");
    }
} else {
    // Redirect users to the login page if they access login.php directly without submitting the form.
    header("location: login.html");
    exit();
}
?>
