<?php
session_start();

// 1. አድሚኑ መግባቱን ማረጋገጥ
if(!isset($_SESSION['admin_logged_in'])) { 
    header('Location: login.php'); 
    exit(); 
}

include 'db_connect.php';

// 2. ID መላኩን ማረጋገጥ
if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // 3. የዕቃውን ሁኔታ ወደ 'Returned' መቀየር
    $query = "UPDATE items SET status='Returned' WHERE id = $id";
    
    if(mysqli_query($conn, $query)) {
        // ስኬታማ ከሆነ ወደ admin_dashboard.php ይመለስ (ስሙን አስተካክዬዋለሁ)
        header('Location: admin_dashboard.php?msg=updated');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    // ID ከሌለ ወደ ዳሽቦርድ ይመለስ
    header('Location: admin_dashboard.php');
    exit();
}
?>