<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS pollpulse_db";
if ($conn->query($sql) === TRUE) {
    echo "Database created or already exists.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

$conn->select_db("pollpulse_db");



$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    gmail VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    role ENUM('admin','user') NOT NULL DEFAULT 'user'
)";
if ($conn->query($sql) === TRUE) {
    echo "users table created.<br>";
} else {
    echo "Error creating users table: " . $conn->error . "<br>";
}



$sql = "CREATE TABLE IF NOT EXISTS polls (
    poll_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE ON UPDATE CASCADE
)";
if ($conn->query($sql) === TRUE) {
    echo "polls table created.<br>";
} else {
    echo "Error creating polls table: " . $conn->error . "<br>";
}



$sql = "CREATE TABLE IF NOT EXISTS poll_options (
    option_id INT AUTO_INCREMENT PRIMARY KEY,
    poll_id INT NOT NULL,
    option_text VARCHAR(255) NOT NULL,
    FOREIGN KEY (poll_id) REFERENCES polls(poll_id)
        ON DELETE CASCADE ON UPDATE CASCADE
)";
if ($conn->query($sql) === TRUE) {
    echo "poll_options table created.<br>";
} else {
    echo "Error creating poll_options table: " . $conn->error . "<br>";
}



$sql = "CREATE TABLE IF NOT EXISTS votes (
    vote_id INT AUTO_INCREMENT PRIMARY KEY,
    poll_id INT NOT NULL,
    option_id INT NOT NULL,
    user_id INT NOT NULL,
    vote_time DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (poll_id) REFERENCES polls(poll_id)
        ON DELETE CASCADE ON UPDATE CASCADE,

    FOREIGN KEY (option_id) REFERENCES poll_options(option_id)
        ON DELETE CASCADE ON UPDATE CASCADE,

    FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE ON UPDATE CASCADE
)";
if ($conn->query($sql) === TRUE) {
    echo "votes table created.<br>";
} else {
    echo "Error creating votes table: " . $conn->error . "<br>";
}


echo "<br>🎉 ALL TABLES CREATED SUCCESSFULLY!";
$conn->close();
?>
