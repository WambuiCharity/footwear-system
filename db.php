<?php
$mysql_hostname = "sql8.freesqldatabase.com";
$mysql_user = "sql8654148";
$mysql_password = "KgPdFcec6B";
$mysql_database = "sql8654148";
$mysql_port = 3306; // Change this to your desired port number
$prefix = "";

// Create a MySQLi object for database connection with the specified port
$mysqli = new mysqli($mysql_hostname, $mysql_user, $mysql_password, $mysql_database, $mysql_port);

// Check for connection errors
if ($mysqli->connect_error) {
    die("Could not connect to the database: " . $mysqli->connect_error);
}

// Select the database
if (!$mysqli->select_db($mysql_database)) {
    die("Could not select the database: " . $mysqli->error);
}

// Optionally, set character set to utf8 (if needed)
if (!$mysqli->set_charset("utf8")) {
    echo "Error setting character set: " . $mysqli->error;
    // Handle this error as needed
}

// Create the "users" table
$createUsersTableSQL = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    fullName VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Contact VARCHAR(20) NOT NULL,
    Address TEXT NOT NULL,
    Role VARCHAR(20) NOT NULL
)";
if ($mysqli->query($createUsersTableSQL) === TRUE) {
    echo "Table 'users' created successfully.";
} else {
    echo "Error creating table: " . $mysqli->error;
}

// Don't forget to close the connection when you're done
$mysqli->close();
?>
