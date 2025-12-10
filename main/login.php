<?php
session_start();
require_once "connection_db.php";

/* ---------------- REMEMBER ME CHECK ---------------- */
$remember_enabled = (
    isset($_COOKIE['remember_email']) &&
    isset($_COOKIE['remember_password'])
);

/* ---------------- AUTO LOGIN USING COOKIES ---------------- */
if (!isset($_SESSION['user_id'])) {

    if ($remember_enabled) {

        $email = $_COOKIE['remember_email'];
        $password = $_COOKIE['remember_password'];

        $sql = "SELECT * FROM users WHERE gmail='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row) {

            $_SESSION['user_id']  = $row['id'];
            $_SESSION['username'] = $row['name'];
            $_SESSION['email']    = $row['gmail'];
            $_SESSION['role']     = $row['role'];

            if ($row['role'] === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: poll.php");
            }
            exit;
        }
    }
}

/* ---------------- MANUAL LOGIN ---------------- */
if (isset($_POST['sign_in'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE gmail='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {

        $error_message = "Wrong email or password";

    } else {

        $_SESSION['user_id']  = $row['id'];
        $_SESSION['username'] = $row['name'];
        $_SESSION['email']    = $row['gmail'];
        $_SESSION['role']     = $row['role'];

        /* SAVE REMEMBER ME ONLY IF CHECKED */
        if (isset($_POST['remember'])) {

            // Universal cookie path
            setcookie("remember_email", $row['gmail'], time() + (86400 * 30), "/");
            setcookie("remember_password", $row['password'], time() + (86400 * 30), "/");

        } else {

            // Delete cookies if checkbox not selected
            setcookie("remember_email", "", time() - 3600, "/");
            setcookie("remember_password", "", time() - 3600, "/");
        }

        if ($row['role'] === 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: poll.php");
        }
        exit;
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

        <?php 
        if (isset($error_message)) {
        echo "<p style='color:red; text-align:center; font-size:1.8rem; margin-bottom:1rem; margin-top: -5rem;'>$error_message</p>";
        } else if (isset($_GET['created']) && $_GET['created'] == 1){
          echo "<p style='color:green; text-align:center; font-size:1.8rem; margin-bottom:1rem; margin-top: -4.4rem;'>Account created successfully! <br> now you can login</p>";

        }

        // if (isset($_GET['created']) && $_GET['created'] == 1) {
        //   echo "<p style='color:green; text-align:center; font-size:1.8rem; margin-bottom:1rem; margin-top: -4.4rem;'>Account created successfully! <br> now you can login</p>";
        // }
        ?>

          <h2 class="login-heading secondary-heading">
            Sign in to Your Account
          </h2>
          <p class="login-subtext">
            Access your dashboard and manage your polls
          </p>

          <div class="login-card">
           <form class="login-form" action="" method="POST">

    <div class="form-group">
        <label for="login-email">email</label>
        <input
            required
            type="email"
            name="email"
            id="login-email"
            placeholder="Enter your email"
            value="<?php echo isset($_COOKIE['remember_email']) ? $_COOKIE['remember_email'] : ''; ?>"
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
            value="<?php echo isset($_COOKIE['remember_password']) ? $_COOKIE['remember_password'] : ''; ?>"
        />
    </div>

    <div class="remember-row">
        <input type="checkbox" id="remember" name="remember" />
        <label for="remember">Remember me</label>
    </div>

    <button type="submit" id="login-btn" name="sign_in">Log in</button>
    <div class="register">
        <p>Don't have an account?</p>
        <a href="../main/sign_up.php" id="register-link">Register here</a>
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