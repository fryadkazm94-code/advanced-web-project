<?php
ob_start();
require_once "connection_db.php";

if (!isset($_POST['poll_id']) || !isset($_POST['option_id'])) {
    echo "Invalid vote.";
    exit;
}

$poll_id   = (int) $_POST['poll_id'];
$option_id = (int) $_POST['option_id'];

// Get option text for confirmation page
$sql_opt = "SELECT option_text FROM poll_options WHERE option_id = $option_id";
$res_opt = mysqli_query($conn, $sql_opt);
$opt = mysqli_fetch_assoc($res_opt);
$option_text = urlencode($opt['option_text']);

// Update vote count
$sql = "UPDATE poll_options SET votes = votes + 1 WHERE option_id = $option_id";
mysqli_query($conn, $sql);

// Redirect to success page
header("Location: vote_success.php?poll_id=$poll_id&option_text=$option_text");
exit;
