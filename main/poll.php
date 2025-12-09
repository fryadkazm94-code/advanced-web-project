<?php
session_start();

// USER MUST BE LOGGED IN
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// INCLUDE THE CUSTOM HEADER
include 'altered_header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Poll</title>

    <!-- Your global CSS -->
    <link rel="stylesheet" href="style.css" />

    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<style>

.poll-page {
gap: 4rem;
width: 100%;
display: flex;
padding: 0 4rem;
margin-top: 8rem;
}

aside {
    color: #0d3791;
    font-weight: 600;
    font-size: 1.8rem;
}

.poll-container {
width: 70%;
display: flex;
max-width: 100rem;
margin: 0 auto;
border-radius: 16px;
background: #ffffff;
flex-direction: column;
gap: 1.2rem;padding: 3rem;
box-shadow: 0 6px 20px #00000014;
}

.poll-container h2 {
color: #0d3791;
font-size: 2.4rem;
margin-bottom: 1rem;
}

label {
font-weight: 500;
font-size: 1.6rem;
margin-bottom: 0;
}

.poll-container input[type="text"] {
width: 100%;
font-size: 1.6rem;
border-radius: 8px;
padding: 1.2rem 1.4rem;
border: 1px solid #cbd5e1;
}

.options-wrapper {
gap: 1rem; 
display: flex;
margin-top: 0.5rem;
flex-direction: column;
}

.option-field {
width: 100%;
position: relative;
}

.delete-option {
top: 50%;
right: 1rem;
color: #888;
cursor: pointer;
font-size: 2rem;
position: absolute;
transform: translateY(-50%);
}

.delete-option:hover {
color: #d11a2a;
}

.buttons-row {
display: flex;
margin-top: 2rem;
justify-content: space-between;
}

.add-option-btn,
.create-poll-btn {
border: none;
cursor: pointer;
font-weight: 600;
transition: 0.3s;
font-size: 1.6rem;
border-radius: 10px;
padding: 1.4rem 2rem;
}

.add-option-btn {
gap: 0.6rem;
display: flex;
align-items: center;
background: var(--hover-color);
color: var(--hero-background);
}

.add-option-btn:hover {
background: var(--cta-hover);
}

.create-poll-btn {
color: #ffffff;
background: #0d3791;
}

.create-poll-btn:hover {
opacity: 0.8;
}

.plus-icon{
    width: 2rem;
    height: 2rem;
    color: #000000;
}

input:focus{
    box-shadow: 0 0 4px #0d379166;
}

.flex-container{
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 2.4rem 2.4rem 0 2.4rem;
}

.flex-container a{
    color: #0d3791;
    font-weight: 600;
    font-size: 1.8rem !important;
}

.flex-container a:hover{
    text-decoration: underline;
}
</style>
</head>

<body>
    <div class="flex-container"><aside>
        Welcome, <?php echo htmlspecialchars($username); ?>
    </aside>
<a href="">
    view all polls
</a></div>
    
<div class="poll-page">

    

    <form class="poll-container" action = "../main/poll_action.php" method = "POST">
        <?php
        if (isset($_GET['success']) && $_GET['success'] === 'poll_created') {
            echo "<p style='color:green; text-align:center; font-size:1.8rem;'>Poll created successfully!</p>";
        }

        if (isset($_GET['error'])) {
            if ($_GET['error'] === 'empty_title') {
            echo "<p style='color:red; text-align:center; font-size:1.8rem;'>Poll title cannot be empty.</p>";
            }
        if ($_GET['error'] === 'not_enough_options') {
             echo "<p style='color:red; text-align:center; font-size:1.8rem;'>You must provide at least 2 options.</p>";
        }
}
?>

        <h2>Create a New Poll</h2>

        <label for="question">Title</label>
        <input name= "title" type="text" id="question" placeholder="Type your question here" required />

        <label>Answer Options</label>
        <div class="options-wrapper" id="options-wrapper">

            <div class="option-field">
                <input type="text" class="option-input" placeholder="Option 1" name="options[]"/>
            </div>

            <div class="option-field">
                <input type="text" class="option-input" placeholder="Option 2" name="options[]"/>
            </div>
        </div>

        <div class="buttons-row">
            <button class="add-option-btn" id="add-option-btn">
                <ion-icon class= "plus-icon" name="add-circle-outline"></ion-icon>
                Add option
            </button>

            <button type= "submit" class="create-poll-btn" id="create-poll-btn">
                Create Poll
            </button>
        </div>
    </form>
</div>

<script src="../main/poll.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
