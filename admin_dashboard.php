<?php
// 1. PHP Logic (ዳታቤዝ እና ሴሽን)
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

include 'db_connect.php';

// ስታቲስቲክስ ማውጣት
$total_res = mysqli_query($conn, "SELECT COUNT(id) as total FROM items");
$total_data = mysqli_fetch_assoc($total_res);

$returned_res = mysqli_query($conn, "SELECT COUNT(id) as total FROM items WHERE status='Returned'");
$returned_data = mysqli_fetch_assoc($returned_res);

$active_res = mysqli_query($conn, "SELECT COUNT(id) as total FROM items WHERE status != 'Returned'");
$active_data = mysqli_fetch_assoc($active_res);

$result = mysqli_query($conn, "SELECT * FROM items ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<header>
    <div class="container">
        <div class="logo"><h1>Admin <span>Dashboard</span></h1></div>
        <nav>
            <a href="index.php">Website</a>
            <a href="logout.php" class="btn-logout">Logout</a>
        </nav>
    </div>
</header>

<div class="container">
    <div class="stats-container">
        <div class="stat-card card-total">
            <h3><?php echo $total_data['total']; ?></h3>
            <p>Total Reports</p>
        </div>
        <div class="stat-card card-returned">
            <h3><?php echo $returned_data['total']; ?></h3>
            <p>Returned</p>
        </div>
        <div class="stat-card card-active">
            <h3><?php echo $active_data['total']; ?></h3>
            <p>Active</p>
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                <td>
                    <span class="status-badge <?php echo ($row['status'] == 'Found') ? 'status-found' : (($row['status'] == 'Returned') ? 'status-returned' : 'status-lost'); ?>">
                        <?php echo $row['status']; ?>
                    </span>
                </td>
                <td>
                    <a href="delete_item.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete?')"><i class="fas fa-trash"></i></a>
                    <?php if($row['status'] != 'Returned'): ?>
                        | <a href="mark_returned.php?id=<?php echo $row['id']; ?>">Mark Returned</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>