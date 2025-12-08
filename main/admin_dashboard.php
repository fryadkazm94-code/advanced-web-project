<?php
session_start();

// User must be logged in AND must be admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome Admin, <?php echo $_SESSION['username']; ?>!</h1>
    <p>You are logged in as an administrator.</p>

    <a href="logout.php">Logout</a>
</body>
</html>
