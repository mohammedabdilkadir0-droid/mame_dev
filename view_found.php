<?php 
// 1. Include the database connection
include 'db_connect.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Found Items - Worabe University</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>Worabe <span>University</span></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="report.php">Report Item</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2 class="section-title">Items Found on Campus</h2>
        
        <div class="found-grid">
            <?php
            // 2. Fetch only items where status is 'Found' and not yet returned
            $sql = "SELECT * FROM items WHERE status = 'Found' ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);

            // 3. Check if there are any results
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="found-card">
                        <div class="item-image-box">
                            <?php if (!empty($row['item_image']) && file_exists("uploads/" . $row['item_image'])): ?>
                                <img src="uploads/<?php echo $row['item_image']; ?>" alt="Found Item">
                            <?php else: ?>
                                <div style="display:flex; align-items:center; justify-content:center; height:100%; color:#ccc;">
                                    <i class="fas fa-image fa-3x"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="item-info">
                            <span class="status-badge status-found">
                                <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($row['status']); ?>
                            </span>
                            
                            <h3><?php echo htmlspecialchars($row['item_name']); ?></h3>
                            <p><i class="fas fa-phone-alt"></i> <strong>Contact:</strong> <?php echo htmlspecialchars($row['phone']); ?></p>
                            <p><i class="fas fa-calendar-alt"></i> <strong>Category:</strong> <?php echo htmlspecialchars($row['category']); ?></p>
                        </div>
                    </div>
                    <?php
                }
            } else {
                // Message displayed if no items are found in the database
                echo "<p style='text-align:center; width:100%; padding: 50px; color: #95a5a6;'>No found items reported yet.</p>";
            }
            ?>
        </div>
    </div>

    <footer style="text-align: center; padding: 20px; color: #7f8c8d; margin-top: 50px;">
        <p>&copy; 2026 Worabe University Lost & Found Portal</p>
    </footer>
</body>
</html>