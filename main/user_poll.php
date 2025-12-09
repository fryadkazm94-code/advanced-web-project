<?php
session_start();
require_once "connection_db.php";

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Get all polls for this user
$sql = "SELECT * FROM polls WHERE user_id = $user_id ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Polls</title>
    <link rel="stylesheet" href="style.css">

    <style>
        .polls-page {
            padding: 4rem;
        }

        .polls-heading {
            font-size: 3rem;
            color: #0d3791;
        }

        .poll-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
        }

        .poll-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 6px 20px #00000014;
            border: 1px solid #e2e8f0;
        }

        .poll-title {
            font-size: 2rem;
            font-weight: 600;
            color: #0d3791;
            margin-bottom: 1rem;
        }

        .poll-date {
            font-size: 1.3rem;
            color: #475569;
            margin-bottom: 2rem;
        }

        .poll-button {
            padding: 1rem 1.4rem;
            background: #0d3791;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-size: 1.4rem;
            font-weight: 600;
        }

        .empty-message {
            font-size: 2rem;
            margin-top: 2rem;
            color: #475569;
        }

        .flex-container{
            display: flex;
            align-items: center;
            margin-bottom: 3rem;
            justify-content: space-between;
        }
        .flex-container a{
        color: #0d3791;
        font-weight: 600;
        }

        .flex-container a:hover{
            text-decoration: underline;
        }
    </style>
</head>

<body>

<?php include "altered_header.php"; ?>

<div class="polls-page">

<div class="flex-container">
    <h2 class="polls-heading">Your Polls</h2>
    <a href="../main/poll.php">go back</a>
</div>

    <?php
    // If no polls exist
    if (mysqli_num_rows($result) == 0) {
        echo "<p class='empty-message'>You haven't created any polls yet.</p>";
    }
    else {
        echo "<div class='poll-cards'>";

        // Show each poll
        while ($row = mysqli_fetch_assoc($result)) {

            echo "<div class='poll-card'>";

            echo "<div class='poll-title'>" . $row['title'] . "</div>";

            echo "<div class='poll-date'>Created: " . $row['created_at'] . "</div>";

            echo "<a href='view_poll.php?poll_id=" . $row['poll_id'] . "' class='poll-button'>View Poll</a>";

            echo "</div>";
        }

        echo "</div>";
    }
    ?>

</div>

</body>
</html>
