<?php
include 'db_connect.php';

if(isset($_POST['submit'])) {
    // 1. Get Data from Form
    $item_name   = mysqli_real_escape_string($conn, $_POST['item_name']);
    $category    = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $phone       = mysqli_real_escape_string($conn, $_POST['phone']);
    $status      = mysqli_real_escape_string($conn, $_POST['status']);
    $location    = "worabe unversity";

    // 2. Handle Image Upload
    $image_name = $_FILES['item_image']['name'];
    $unique_image_name = "";
    if (!empty($image_name)) {
        $unique_image_name = time() . '_' . $image_name;
        move_uploaded_file($_FILES['item_image']['tmp_name'], "uploads/" . $unique_image_name);
    }

    // 3. Save to Database
    $query = "INSERT INTO items (item_name, category, description, item_image, phone, status, location) 
              VALUES ('$item_name', '$category', '$description', '$unique_image_name', '$phone', '$status', '$location')";

    if(mysqli_query($conn, $query)) {
        
        // --- 4. START EMAIL NOTIFICATION ---
        $to = "admin@worabe.edu.et"; // የአድሚኑ ኢሜይል እዚህ ይግባ
        $subject = "New Report: $item_name ($status)";
        
        $message = "
        <html>
        <head>
            <title>New Lost & Found Report</title>
        </head>
        <body>
            <h2 style='color: #2c3e50;'>New Item Reported!</h2>
            <p><strong>Item Name:</strong> $item_name</p>
            <p><strong>Category:</strong> $category</p>
            <p><strong>Status:</strong> $status</p>
            <p><strong>Reported By:</strong> $phone</p>
            <hr>
            <p>Please log in to the Admin Dashboard to review this report.</p>
        </body>
        </html>
        ";

        // Headers for HTML Email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: Worabe Portal <noreply@worabe.edu.et>" . "\r\n";

        // Send Email
        @mail($to, $subject, $message, $headers);
        // --- END EMAIL NOTIFICATION ---

        echo "<script>alert('Report Saved and Admin Notified!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>