<?php
session_start();
require_once 'connection_db.php';

if (isset($_POST['sign_in'])) {

    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Query database
    $sql = "SELECT * FROM users WHERE gmail='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {

        // SAVE SESSION PROPERLY
        $_SESSION['user_id']   = $row['id'];
        $_SESSION['username']  = $row['name'];
        $_SESSION['email']     = $row['gmail'];
        $_SESSION['password']  = $row['password'];

        header("Location: user_dashboard.php");
        exit;

    } else {
        echo "<p style='color:red; text-align:center;'>Wrong email or password</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PollPulse</title>
    <link rel="stylesheet" href="style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="../favicons/favicon-16x16.png" />
    <link rel="icon" href="../favicons/favicon.ico" />
</head>
<body>
<?php
include "header.php";
?>

    <section class="login-section" id="login">
        <div class="login-container">
          <h2 class="login-heading secondary-heading">
            Sign in to Your Account
          </h2>
          <p class="login-subtext">
            Access your dashboard and manage your polls
          </p>

          <div class="login-card">
            <form class="login-form" action="" method="POST">
              <div class="form-group">
                <label for="login-username">email</label>
                <input
                  required
                  type="email"
                  name="email"
                  id="login-username"
                  placeholder="Enter your email"
                />
              </div>

              <div class="form-group">
                <label for="login-password">Password</label>
                <input
                  required
                  type="password"
                  name="password"
                  id="login-password"
                  placeholder="Enter your password"
                />
              </div>

              <div class="remember-row">
                <input type="checkbox" id="remember" name="remember" />
                <label for="remember">Remember me</label>
              </div>

              <button type="submit" id="login-btn" name="sign_in">Log in</button>
              <div class="register">
                <p>Don't have an account?</p>
                <a href="sign_up.php" id="register-link">Register here</a>
              </div>
            </form>
          </div>
        </div>
      </section>

<style>

#register .login-container {
  margin-top: 4rem;
}

#register .login-heading {
  margin-bottom: 1rem;
}

#register #login-btn {
  width: 100%;
}

#register-link {
  font-size: 1.6rem;
  color: #2563eb;
  text-decoration: underline;
}

#register-link:hover {
  text-decoration: none;
}
</style>

<script src="../main/index.js"></script>

</body>
</html>