<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pollpulse_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input_username = $_POST['username'];
    $input_password = $_POST['password'];
    $remember = isset($_POST['remember']);

    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $db_username, $db_password, $role);
        $stmt->fetch();

        if (password_verify($input_password, $db_password)) {

            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $db_username;
            $_SESSION['role'] = $role;

            if ($remember) {
                setcookie("remember_user", $db_username, time() + (30*24*60*60), "/");
            }

            if ($role === "admin") {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit;

        } else {
            echo "Incorrect password.";
        }

    } else {
        echo "User not found.";
    }

    $stmt->close();
}

$conn->close();
?>
