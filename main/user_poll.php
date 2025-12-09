<?php
session_start();
require_once "connection_db.php";

// USER MUST BE LOGGED IN
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// FETCH ALL POLLS CREATED BY THIS USER
$sql = "SELECT * FROM polls WHERE user_id = $user_id ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Polls</title>

    <link rel="stylesheet" href="style.css">

    <style>
        .polls-page {
            width: 100%;
            padding: 4rem;
            margin-top: 8rem;
        }

        .polls-heading {
            font-size: 3rem;
            color: #0d3791;
            margin-bottom: 3rem;
            font-weight: 700;
        }

        .poll-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
        }

        .poll-card {
            background: #ffffff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 6px 20px #00000014;
            transition: 0.3s;
            border: 1px solid #e2e8f0;
        }

        .poll-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 28px #00000021;
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
            margin-bottom: 1.8rem;
        }

        .poll-button {
            display: inline-block;
            background: #0d3791;
            padding: 1rem 1.4rem;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-size: 1.4rem;
            font-weight: 600;
            transition: 0.3s;
        }

        .poll-button:hover {
            opacity: 0.85;
        }

        .empty-message {
            font-size: 2rem;
            color: #475569;
            margin-top: 2rem;
        }
    </style>
</head>

<body>

<?php include "altered_header.php"; ?>

<div class="polls-page">

    <h2 class="polls-heading">Your Polls</h2>

    <?php if (mysqli_num_rows($result) === 0): ?>
        <p class="empty-message">You haven't created any polls yet.</p>

    <?php else: ?>

        <div class="poll-cards">

            <?php while ($row = mysqli_fetch_assoc($result)): ?>

                <div class="poll-card">
                    <div class="poll-title">
                        <?= htmlspecialchars($row['title']) ?>
                    </div>

                    <div class="poll-date">
                        Created: <?= date("F j, Y", strtotime($row['created_at'])) ?>
                    </div>

                    <a href="view_poll.php?poll_id=<?= $row['id'] ?>" class="poll-button">
                        View Poll
                    </a>
                </div>

            <?php endwhile; ?>

        </div>

    <?php endif; ?>

</div>

</body>
</html>
