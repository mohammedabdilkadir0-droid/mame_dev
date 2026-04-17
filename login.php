<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_dashboard.php');
        exit();
    } else {
        $error = "Incorrect username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Worabe University</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-card {
        background: #ffffff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.3);
        width: 100%;
        max-width: 380px;
        text-align: center;
    }

    .profile-img {
        width: 100px;
        height: 100px;
        margin: 0 auto 20px;
        border-radius: 50%;
        border: 4px solid #3498db;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        overflow: hidden; /* ምስሉ ክብ እንዲሆን መቁረጫ */
    }

    .profile-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .login-card h2 {
        margin: 10px 0;
        color: #2c3e50;
    }

    .login-card p {
        color: #7f8c8d;
        font-size: 14px;
        margin-bottom: 25px;
    }

    .form-group {
        text-align: left;
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #34495e;
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        border: 2px solid #ecf0f1;
        border-radius: 10px;
        box-sizing: border-box;
    }

    .btn-submit {
        width: 100%;
        padding: 14px;
        background: #2c3e50;
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-submit:hover { background: #3498db; }

    .error-msg {
        background: #f8d7da;
        color: #721c24;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .back-link {
        display: inline-block;
        margin-top: 20px;
        text-decoration: none;
        color: #7f8c8d;
        font-size: 14px;
    }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="profile-img">
            <img src="images/admin_profile.png" alt="Admin Profile">
        </div>

        <h2>Admin Portal</h2>
        <p>Worabe University Lost & Found</p>

        <?php if(isset($error)): ?>
            <div class="error-msg">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label><i class="fas fa-user"></i> Username</label>
                <input type="text" name="username" placeholder="Enter admin username" required>
            </div>
            
            <div class="form-group">
                <label><i class="fas fa-key"></i> Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-submit">LOGIN NOW</button>
        </form>

        <a href="index.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Homepage</a>
    </div> </body>
</html>