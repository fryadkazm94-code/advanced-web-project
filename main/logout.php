<?php
session_start();
session_unset();
session_destroy();

// Remove remember-me cookie
setcookie("remember_user", "", time() - 3600, "/");

// Redirect home
header("Location: index.php");
exit;
?>
