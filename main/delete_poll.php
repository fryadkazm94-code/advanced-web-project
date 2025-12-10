<?php
session_start();
require_once "connection_db.php";

// Only admin allowed
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

if (!isset($_GET['poll_id'])) {
    echo "No poll selected.";
    exit;
}

$poll_id = $_GET['poll_id'];

// deleting the poll options of the deleted poll based on the id that is unique to each poll
mysqli_query($conn, "DELETE FROM poll_options WHERE poll_id=$poll_id");

// delete the poll itself.
mysqli_query($conn, "DELETE FROM polls WHERE poll_id=$poll_id");

// redirect the admin to the previous page he was at.
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
