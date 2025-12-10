<?php
session_start();
require_once "connection_db.php";

// Only admin allowed
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

// Get all normal users
$sql = "SELECT * FROM users WHERE role='user'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">

    <style>
        
        .admin-container {
            padding: 3rem;
            margin: 0 auto;
            max-width: 80rem;
            margin-top: 18rem;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 6px 20px #00000024;
        }

        .user-card {
            border-radius: 12px;
            padding: 1.4rem 2rem;
            margin-bottom: 1.6rem;
            background: #f3f4f6;
            border: 1px solid #e2e8f0;
        }

        .username {
            font-size: 2rem;
            font-weight: 600;
            color: #0d3791;
        }

        .view-btn {
            color: #ffffff;
            margin-top: 1rem;
            font-weight: 600;
            border-radius: 10px;
            padding: 1rem 1.6rem;
            background: #0d3791;
            text-decoration: none;
            display: inline-block;
        }

        .go-back{
            margin-top: 2.4rem;
            margin-left: 2.4rem;
            color: #0d3791 !important;
        }

        .go-back:hover{
            text-decoration: underline;
        }

    </style>
</head>

<body>


<a href="../main/login.php" class="go-back">go back</a>

<div class="admin-container">
    <h2 style="font-size:2.4rem; color:#0d3791; margin-bottom:2rem;">All Users</h2>

    <?php while ($user = mysqli_fetch_assoc($result)) { ?>
        <div class="user-card">
            <div class="username"><?php echo $user['name']; ?>'s Polls</div>
            <a class="view-btn" href="admin_view_user_poll.php?user_id=<?php echo $user['id']; ?>">
                View Polls
            </a>
        </div>
    <?php } ?>

</div>

</body>
</html>
