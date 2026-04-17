<?php
// --- 1. PHP LOGIC PART ---
session_start();
include 'db_connect.php';

// 1. Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$error_msg = "";

if (isset($_GET['id'])) {
    // 2. Sanitize the ID for security (Prevents SQL Injection)
    $id = intval($_GET['id']);

    // 3. First, get the image name from the database to delete it from the folder
    $img_query = "SELECT item_image FROM items WHERE id = $id";
    $img_result = mysqli_query($conn, $img_query);
    $img_data = mysqli_fetch_assoc($img_result);

    if ($img_data) {
        $file_path = "uploads/" . $img_data['item_image'];
        // Delete the file from the 'uploads' folder if it exists and is not empty
        if (!empty($img_data['item_image']) && file_exists($file_path)) {
            unlink($file_path);
        }
    }

    // 4. Now, delete the record from the database
    $sql = "DELETE FROM items WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Redirect back to dashboard with a success message
        header("Location: admin_dashboard.php?msg=deleted");
        exit();
    } else {
        // Store the error if the query fails
        $error_msg = "Error deleting record: " . mysqli_error($conn);
    }
} else {
    // Redirect back to dashboard if no ID is provided
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Operation - Error</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="container">
    <div class="action-container error-box">
        <i class="fas fa-exclamation-circle" style="font-size: 50px; color: #e74c3c; margin-bottom: 20px;"></i>
        <h2>Operation Failed</h2>
        <p><?php echo $error_msg; ?></p>
        <a href="admin_dashboard.php" class="btn-return">Return to Dashboard</a>
    </div>
</div>

</body>
</html>