<?php
session_start();
require_once "connection_db.php";

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Get form data
$title = $_POST['title'];
$options = $_POST['options'];

// Check empty title
if ($title == "") {
    header("Location: poll.php?error=empty_title");
    exit;
}

// Count non-empty options
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

// -----------------------------
// INSERT POLL
// -----------------------------
$sql_poll = "INSERT INTO polls (user_id, title, created_at)
             VALUES ('$user_id', '$title', NOW())";

mysqli_query($conn, $sql_poll);

// Get the poll id we just created
$poll_id = mysqli_insert_id($conn);

// -----------------------------
// INSERT OPTIONS
// -----------------------------
foreach ($options as $op) {
    if ($op != "") {
        $sql_opt = "INSERT INTO poll_options (poll_id, option_text)
                    VALUES ('$poll_id', '$op')";
        mysqli_query($conn, $sql_opt);
    }
}

// -----------------------------
// REDIRECT TO VIEW THE POLL
// -----------------------------
header("Location: view_poll.php?poll_id=" . $poll_id);
exit;

?>
