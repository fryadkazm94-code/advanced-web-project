<?php
session_start();

if (!isset($_GET['poll_id']) || !isset($_GET['option_text'])) {
    echo "Invalid vote.";
    exit;
}

$poll_id = $_GET['poll_id'];
$option_text = $_GET['option_text'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vote Submitted</title>

    <style>
        body {
            background: #f4f4f9;
            font-family: Arial, sans-serif;
        }

        .success-box {
            max-width: 500px;
            margin: 10rem auto;
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 8px 20px #00000025;
        }

        h1 {
            color: #0d3791;
            margin-bottom: 1.5rem;
        }

        .btn {
            display: inline-block;
            margin-top: 2rem;
            padding: 1rem 2rem;
            background: #0d3791;
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn:hover {
            opacity: 0.85;
        }
    </style>
</head>

<body>

<div class="success-box">
    <h1>Vote Submitted!</h1>

    <p>You voted for: <strong><?php echo htmlspecialchars($option_text); ?></strong></p>

    <a href="view_poll.php?poll_id=<?php echo $poll_id; ?>" class="btn">Back to Poll</a>
</div>

</body>
</html>
