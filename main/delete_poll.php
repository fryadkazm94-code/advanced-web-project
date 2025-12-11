<?php
session_start();
require_once "connection_db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

if (!isset($_GET['poll_id'])) {
    echo "No poll selected.";
    exit;
}

$poll_id = $_GET['poll_id'];

mysqli_query($conn, "DELETE FROM poll_options WHERE poll_id=$poll_id");

mysqli_query($conn, "DELETE FROM polls WHERE poll_id=$poll_id");

header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
