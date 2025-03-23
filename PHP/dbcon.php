<?php
$dbHost = "localhost"; // Host
$dbUser = "root"; // User
$dbPassword = ""; // Password
$dbName = "pharmasee"; // Database

// Establishing a connection to the database
$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

// Checking if the connection was successful
if ($conn->connect_error) {
    // If connection failed, output an error message and terminate the script
    die("Connection failed: " . $conn->connect_error);
}
?>
