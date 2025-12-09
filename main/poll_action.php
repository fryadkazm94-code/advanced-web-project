<?php
session_start();
require_once "connection_db.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Get form data
$title = $_POST['title'];
$options = $_POST['options'];

// Check if title is empty
if ($title == "") {
    header("Location: poll.php?error=empty_title");
    exit;
}

// Count how many options user entered
$option_count = 0;
foreach ($options as $op) {
    if ($op != "") {
        $option_count++;
    }
}

// Must have at least 2 options
if ($option_count < 2) {
    header("Location: poll.php?error=not_enough_options");
    exit;
}

// Insert poll into polls table
$sql_poll = "INSERT INTO polls (user_id, title) VALUES ('$user_id', '$title')";
mysqli_query($conn, $sql_poll);

// Get the newly created poll ID
$poll_id = mysqli_insert_id($conn);

// Insert each option
foreach ($options as $op) {
    if ($op != "") {   // Ignore empty ones
        $sql_opt = "INSERT INTO poll_options (poll_id, option_text) VALUES ('$poll_id', '$op')";
        mysqli_query($conn, $sql_opt);
    }
}


// Redirect after success
header("Location: view_poll.php?id=$poll_id");
exit;
?>
