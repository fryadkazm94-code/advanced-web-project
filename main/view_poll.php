<?php
session_start();
require_once "connection_db.php";

// Make sure poll ID exists
if (!isset($_GET['id'])) {
    echo "No poll selected.";
    exit;
}

$poll_id = $_GET['id'];

// Get poll
$sql_poll = "SELECT * FROM polls WHERE poll_id = '$poll_id'";
$result_poll = mysqli_query($conn, $sql_poll);

if (mysqli_num_rows($result_poll) === 0) {
    echo "Poll not found.";
    exit;
}

$poll = mysqli_fetch_assoc($result_poll);

// Get poll options
$sql_options = "SELECT * FROM poll_options WHERE poll_id = '$poll_id'";
$result_options = mysqli_query($conn, $sql_options);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $poll['title']; ?></title>

    <link rel="stylesheet" href="style.css">

    <style>
        body{
            background-color: #eaeaeaff;
        }

        .view-container {
            margin: 0 auto;
            padding: 3rem;
            max-width: 80rem;
            margin-top: 11rem;
            border-radius: 14px;
            background: #ffffff;
            box-shadow: 0 8px 25px #0000003f;
        }

        .poll-title {
            font-size: 2.6rem;
            color: #0d3791;
            font-weight: 700;
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .option-box {
            font-size: 1.8rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            background: #f3f4f6;
            padding: 1.4rem 1.8rem;
            border: 1px solid #e2e8f0;
        }

        .back-btn {
            display: block;
            color: #ffffff;
            font-weight: 600;
            margin-top: 2.5rem;
            text-align: center;
            border-radius: 10px;
            padding: 1.2rem 2rem;
            text-decoration: none;
            transition: all 0.3s;
            background: #0d3791;
        }

        .back-btn:hover {
            opacity: 0.85;
        }
    </style>
</head>

<body>

<?php include 'altered_header.php'; ?>

<div class="view-container">
    <h1 class="poll-title"><?php echo htmlspecialchars($poll['title']); ?></h1>

    <?php while ($row = mysqli_fetch_assoc($result_options)) { ?>
        <div class="option-box">
            <?php echo htmlspecialchars($row['option_text']); ?>
        </div>
    <?php } ?>

    <a href="poll.php" class="back-btn">Create another poll</a>
</div>

</body>
</html>
