<?php
// Database credentials
$servername = "localhost";
$db_username = "your_username";  // Update with your actual username
$db_password = "your_password";  // Update with your actual password
$dbname = "CampusBike";  // Update with your actual database name

// Create a new database connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
