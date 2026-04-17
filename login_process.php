<?php
session_start(); // Session ለመጀመር

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ለአሁኑ በቋሚነት (Static) የተቀመጠ User
    if ($username == "admin" && $password == "12345") {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php"); // ወደ ዳሽቦርድ ይወስዳል
    } else {
        echo "<script>alert('Invalid Username or Password!'); window.location='login.php';</script>";
    }
}
?>