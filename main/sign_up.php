<?php
require_once 'connection_db.php';

if (isset($_POST['signup'])) {

    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check = "SELECT * FROM users WHERE gmail='$email'";
    $check_result = mysqli_query($conn, $check);

    if (mysqli_num_rows($check_result) > 0) {
      $error_message = "Gmail is already in use";
    }

    else if(strlen($password) < 8){
      $error_message = "Password must be greater than 8 characters";
    }

    else {
      $sql = "INSERT INTO users (name, gmail, password) VALUES ('$name', '$email', '$password')";
      $result = mysqli_query($conn, $sql);

    if ($result) {
      header("Location: login.php?created=1");
        exit;
    } else {
        echo "<p style='color:red; text-align:center;'>Error: " . mysqli_error($conn) . "</p>";
      }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | PollPulse</title>
    <link rel="stylesheet" href="style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="../favicons/favicon-16x16.png" />
    <link rel="icon" href="../favicons/favicon.ico" />
</head>
<body>


<?php 
include 'header.php';
?>
<section class="login-section" id="register">
  <div class="login-container">
    <?php 
    if (isset($error_message)) {
    echo "<p style='color:red; text-align:center; font-size:1.8rem; margin-bottom:1rem; margin-top: -2.4rem;'>$error_message</p>";
    }
    ?>
    <h2 class="login-heading secondary-heading">Create Your Account</h2>
    <p class="login-subtext">Join PollPulse and start creating polls instantly</p>

    <div class="login-card">

      <form class="login-form" action="" method="POST">

        <div class="form-group">
          <label for="reg-username">Username</label>
          <input 
            required
            type="text" 
            name="username" 
            id="reg-username" 
            placeholder="Choose a username"
          />
        </div>

        <div class="form-group">
          <label for="reg-email">Gmail</label>
          <input 
            required
            type="email" 
            name="email" 
            id="reg-email" 
            placeholder="Enter your Gmail"
          />
        </div>

        <div class="form-group">
          <label for="reg-password">Password</label>
          <input 
            required
            type="password" 
            name="password" 
            id="reg-password" 
            placeholder="Create a password"
          />
        </div>

        <button type="submit" id="login-btn" name="signup">sign up</button>

        <div class="register">
          <p>Already have an account?</p>
          <a href="login.php" id="register-link">Login here</a>
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

.login-section{
  padding: 3.6rem 0;
}
</style>


<script src="../main/index.js"></script>

</body>
</html>
