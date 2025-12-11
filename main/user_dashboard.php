<?php
session_start();
require_once 'connection_db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$email   = $_SESSION['email'];
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

$username = $user['name'];
$password = $user['password'];

if (isset($_POST['update_profile'])) {

    $new_email = $_POST['new_email'];
    $new_name  = $_POST['new_username'];
    $new_pass  = $_POST['new_password'];

    $sql = "UPDATE users SET 
            name='$new_name',
            gmail='$new_email',
            password='$new_pass'
            WHERE id='$user_id'";

    if (mysqli_query($conn, $sql)) {

        $_SESSION['username'] = $new_name;
        $_SESSION['email']    = $new_email;
        $_SESSION['password'] = $new_pass;

        $success = "Profile updated successfully!";
    } else {
        $error = "Error updating profile: " . mysqli_error($conn);
    }
}

if (isset($_POST['delete_account'])) {

    mysqli_query($conn, "DELETE FROM users WHERE id='$user_id'");

    setcookie("remember_email", "", time() - 3600, "/");
    setcookie("remember_password", "", time() - 3600, "/");

    session_destroy();
    header("Location: sign_up.php");
    exit;
}

if (isset($_POST['logout'])) {

    setcookie("remember_email", "", time() - 3600, "/");
    setcookie("remember_password", "", time() - 3600, "/");

    session_destroy();
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dashboard | PollPulse</title>
    <link rel="stylesheet" href="style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="../favicons/favicon-16x16.png" />
    <link rel="icon" href="../favicons/favicon.ico" />
</head>

<body>

<?php include 'header.php'; ?>


<div class= "go-back"><ion-icon class="go-back-icon" name="arrow-back-circle-outline"></ion-icon>
<a class= "go-back-link" href="../main/poll.php">go back</a></div>

<?php if (!empty($success)) echo "<p style='color:green; font-size: 18px;
    font-weight: 600; text-align: center;
    '>$success</p>"; ?>

    <?php if (!empty($error)) echo "<p style='color:red;  font-size: 18px; text-align:center;
    font-weight: 600;'>$error</p>"; ?>

<section class="login-section">
  <div class="login-container">
    <h2 class="login-heading secondary-heading">Your Profile</h2>
    <p class="login-subtext">Manage your account information</p>

    <div class="login-card">

      <form class="login-form" action="" method="POST">

        <div class="form-group">
          <label>Your Username</label>
          <input type="text" name="new_username" value="<?php echo $username; ?>" required>
        </div>

        <div class="form-group">
          <label>Your Email</label>
          <input type="email" name="new_email" value="<?php echo $email; ?>" required>
        </div>

        <div class="form-group">
          <label>Your Password</label>
          <input type="text" name="new_password" value="<?php echo $password; ?>" required>
        </div>

        <button type="submit" id="login-btn" name="update_profile">Save Changes</button>

        <button type="button" id="login-btn" onclick="window.location.href='../main/poll.php'">
          Create Poll
        </button>

        <button class= "delete-account-btn"
            type="submit" 
            name="delete_account" >
            Delete My Account
        </button>

        <button class = "logout-btn"
            type="submit" 
            name="logout" >
            Log Out
        </button>
      </form>

    </div>
  </div>
</section>

<style>

  html{
    font-size: 62.5%;
  }

    .delete-account-btn{
        border:none;
        padding: 1.4rem;
        color: #ffffff;
        cursor: pointer;
        font-weight: 600;
        font-size: 1.6rem;
        transition: all 1s;
        border-radius: 1rem;
        border-radius: 1rem;
        background-color: #dc2f02;
    }

    .delete-account-btn:hover, .logout-btn:hover{
      opacity: 0.8;
    }

    .login-section{
      margin: 0 auto;
      max-width: 60rem;
      padding: 1.2rem 0;
    }

    .logout-btn{
        border:none;
        padding: 1.4rem;
        cursor: pointer;
        font-weight: 600;
        color: #ffffff;
        font-size: 1.6rem;
        border-radius: 1rem;
        transition: all 0.35s;
        background-color: var(--hero-background);
    }

    .go-back{
      align-items: center;
      gap: 0.4rem;
      display: flex;
      padding: 1.2rem;
    }

    .go-back:hover{
      text-decoration: underline;
    }

    .go-back-link{
      font-size: 2rem !important;
      color: #000000 !important;
    }

    .go-back-icon{
      width: 2.4rem;
      height: 2.4rem;
      color: #000000;
    }
</style>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
