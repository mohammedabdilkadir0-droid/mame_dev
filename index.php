<?php 
include 'db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worabe University - Lost & Found</title>
    
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->
    
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
                <li><a href="login.php" class="btn-login">Login</a></li>
            </ul>
        </nav>
    </div>
</header>

<section class="hero">
    <div class="container">
        <h2>Lost Something on Campus?</h2>
        <p>Help others find their belongings or report what you've found.</p>
        <a href="report.php" class="btn-primary"><i class="fas fa-plus-circle"></i> Post New Report</a>
    </div>
</section>

<section class="search-section">
    <div class="container">
        <form action="index.php" method="GET" class="search-box">
            <input type="text" name="search" placeholder="Search for items (e.g. ID Card, Keys, Laptop)..." 
                   value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit"><i class="fas fa-search"></i> Search</button>
        </form>
    </div>
</section>

<div class="container">
    <div class="items-grid">
        <?php
        // Prepare search logic: Show items that are NOT marked as 'Returned'
        $search_val = " WHERE status != 'Returned' ";
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search = mysqli_real_escape_string($conn, $_GET['search']);
            $search_val .= " AND item_name LIKE '%$search%' ";
        }

        // Fetch items from the database
        $sql = "SELECT * FROM items $search_val ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                // Determine the status color based on whether it is 'Lost' or 'Found'
                $status_class = ($row['status'] == 'Found') ? 'status-found' : 'status-lost';
                ?>
                <div class="item-card">
                    <span class="status-badge <?php echo $status_class; ?>">
                        <?php echo htmlspecialchars($row['status']); ?>
                    </span>
                    
                    <div class="item-image-box">
                        <?php if(!empty($row['item_image']) && file_exists("uploads/" . $row['item_image'])): ?>
                            <img src="uploads/<?php echo $row['item_image']; ?>" alt="Item Image">
                        <?php else: ?>
                            <div style="display:flex; align-items:center; justify-content:center; height:100%; color:#ccc;">
                                <i class="fas fa-image fa-3x"></i>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="item-info">
                        <h3><?php echo htmlspecialchars($row['item_name']); ?></h3>
                        <p><i class="fas fa-map-marker-alt"></i> Location: Campus</p>
                        <p><i class="fas fa-phone"></i> Contact: <?php echo htmlspecialchars($row['phone']); ?></p>
                        <p style="font-size: 12px; color: #bdc3c7; margin-top: 10px;">
                            Category: <?php echo htmlspecialchars($row['category']); ?>
                        </p>
                    </div>
                </div>
                <?php
            }
        } else {
            // Message to display if no items match the criteria
            echo "<p style='grid-column: 1/-1; text-align:center; padding: 50px; color:#95a5a6;'>No items found matching your search.</p>";
        }
        ?>
    </div>
</div>

<footer>
    <div class="container">
        <p>&copy; 2026 Worabe University Lost & Found Portal</p>
    </div>
</footer>

</body>
</html>