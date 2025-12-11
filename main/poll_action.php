<?php
session_start();
require_once "connection_db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];


$title = $_POST['title'];
$options = $_POST['options'];

if ($title == "") {
    header("Location: poll.php?error=empty_title");
    exit;
}

$option_count = 0;
foreach ($options as $op) {
    if ($op != "") {
        $option_count++;
    }
}

if ($option_count < 2) {
    header("Location: poll.php?error=not_enough_options");
    exit;
}


$sql_poll = "INSERT INTO polls (user_id, title, created_at)
             VALUES ('$user_id', '$title', NOW())";

mysqli_query($conn, $sql_poll);

$poll_id = mysqli_insert_id($conn);


foreach ($options as $op) {
    if ($op != "") {
        $sql_opt = "INSERT INTO poll_options (poll_id, option_text)
                    VALUES ('$poll_id', '$op')";
        mysqli_query($conn, $sql_opt);
    }
}


header("Location: view_poll.php?poll_id=" . $poll_id);
exit;

?>
