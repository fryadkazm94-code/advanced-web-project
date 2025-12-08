<?php
session_start();
require_once 'connection_db.php';

// USER MUST BE LOGGED IN
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Load current user data from session
$user_id   = $_SESSION['user_id'];
$username  = $_SESSION['username'];
$email     = $_SESSION['email'];
$password  = $_SESSION['password'];


// ------------------ UPDATE PROFILE ------------------
if (isset($_POST['update_profile'])) {

    $new_name  = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $new_pass  = $_POST['new_password'];

    $sql = "UPDATE users SET 
            name='$new_name',
            gmail='$new_email',
            password='$new_pass'
            WHERE id='$user_id'";

    if (mysqli_query($conn, $sql)) {

        // Update SESSION so it refreshes instantly
        $_SESSION['username'] = $new_name;
        $_SESSION['email']    = $new_email;
        $_SESSION['password'] = $new_pass;

        $success = "Profile updated successfully!";
    } else {
        $error = "Error updating profile: " . mysqli_error($conn);
    }
}


// ------------------ DELETE ACCOUNT ------------------
if (isset($_POST['delete_account'])) {

    $sql = "DELETE FROM users WHERE id='$user_id'";
    mysqli_query($conn, $sql);

    session_destroy();
    header("Location: sign_up.php");
    exit;
}


// ------------------ LOGOUT ------------------
if (isset($_POST['logout'])) {
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
</head>

<body>

<?php include 'header.php'; ?>

<section class="login-section">
  <div class="login-container">
    <h2 class="login-heading secondary-heading">Your Profile</h2>
    <p class="login-subtext">Manage your account information</p>

    <?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

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

        <button type="button" id="login-btn" onclick="window.location.href='create_poll.php'">
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

    .delete-account-btn{
        border:none;
        padding: 1.4rem;
        color: #ffffff;
        cursor: pointer;
        font-weight: 600;
        font-size: 1.6rem;
        border-radius: 1rem;
        border-radius: 1rem;
        background-color: #dc2f02;
    }


    .login-section{
        padding: 4.4rem;
    }

    .logout-btn{
        border:none;
        padding: 1.4rem;
        cursor: pointer;
        font-weight: 600;
        color: #ffffff;
        font-size: 1.6rem;
        border-radius: 1rem;
        background-color: var(--hero-background);
    }
</style>
</body>
</html>
