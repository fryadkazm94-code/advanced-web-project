<?php
session_start();
require_once "connection_db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

if (!isset($_GET['user_id'])) {
    echo "No user selected.";
    exit;
}

$user_id = $_GET['user_id'];

// Get user info
$sql_user = "SELECT name FROM users WHERE id=$user_id";
$result_user = mysqli_query($conn, $sql_user);
$user = mysqli_fetch_assoc($result_user);

// Get polls for this user
$sql_polls = "SELECT * FROM polls WHERE user_id=$user_id ORDER BY created_at DESC";
$result_polls = mysqli_query($conn, $sql_polls);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $user['name']; ?>'s Polls</title>
    <link rel="stylesheet" href="style.css">

    <style>
        .poll-container {
            max-width: 80rem;
            margin: 8rem auto;
            margin-top: 10rem;
        }

        .poll-card {
            margin: 0 auto;
            width: 50%;
            padding: 1.6rem;
            text-align: center;
            border-radius: 12px;
            background: #ffffff;
            margin-bottom: 1.4rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 14px #0000001a;
        }

        .poll-title {
            color: #0d3791;
            font-weight: 600;
            font-size: 1.8rem;
        }

        .btn {
            color: #ffffff;
            font-weight: 600;
            margin-top: 1rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            padding: 0.8rem 1.4rem;
        }

        h2{
            color:#0d3791;
            font-size:3.6rem;
            text-align:center;
            margin-bottom:2rem;
        }

        .links{
            gap: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .view-btn {
            background: #0d3791;
        }

        .delete-btn {
            background: #d11a2a;
         }

         .go-back{
            color: #0d3791 !important;
            margin: 2.4rem 0 auto 2.4rem;
         }

         .go-back:hover{
            text-decoration: underline;
         }
    </style>
</head>

<body>

<?php include 'altered_header.php'; ?>

<a class= "go-back" href="admin_dashboard.php">go back</a>
<div class="poll-container">

    <?php
$poll_count = mysqli_num_rows($result_polls);

if ($poll_count === 0) {
    echo "<h2 style='color:#d11a2a; font-size:2.4rem; margin-bottom:2rem;'>
            No poll created.
          </h2>";
    } else {
    echo "<h2 style='color:#0d3791; font-size:2.4rem; margin-bottom:2rem;'>
        Polls created by " . $user['name'] . "
        </h2>";

    while ($poll = mysqli_fetch_assoc($result_polls)) {
    echo "<div class='poll-card'>
            <div class='poll-title'>" . $poll['title'] . "</div>
            <a class='btn view-btn' href='view_poll.php?poll_id=" . $poll['poll_id'] . "'>View</a>
            <a class='btn delete-btn' href='delete_poll.php?poll_id=" . $poll['poll_id'] . "'>Delete</a>
            </div>";
    }
}
?>


</div>

</body>
</html>
