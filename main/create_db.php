<?php
// Connect to MySQL server
$conn = new mysqli("localhost", "root", "");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database
$conn->query("CREATE DATABASE IF NOT EXISTS pollpulse_db");
echo "Database created.<br>";

$conn->close();


$conn = new mysqli("localhost", "root", "", "pollpulse_db");

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Users table created.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
