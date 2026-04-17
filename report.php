<?php
// Start session if needed (e.g., for success messages)
session_start();
// Database connection is not strictly required here unless fetching categories, 
// but it's good practice to have it ready.
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Report - Worabe University</title>
    
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
                    <li><a href="report.php" class="active">Report Item</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="form-wrapper">
        <div class="form-container">
            <h2>Submit a New Report</h2>
            <p class="form-subtitle">Help others find what they lost or report what you found.</p>
            
            <form action="save.php" method="POST" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="item_name">Item Name</label>
                    <input type="text" id="item_name" name="item_name" placeholder="e.g. Samsung Galaxy S21, Brown Wallet" required>
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" required>
                        <option value="" disabled selected>Select a category</option>
                        <option value="ID Card">ID Card</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Books">Books</option>
                        <option value="Keys">Keys</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                     <label>Verification Question</label>
                     <textarea name="verification_question" placeholder="Example: What sticker is on the laptop? or What are the last 3 digits of the ID bar code?" required></textarea>
                    <small style="color: #666;">This question helps verify the real owner of the item.</small>
                </div>
                <div class="form-group">
                    <label for="status">Report Type (Status)</label>
                    <select id="status" name="status" required>
                        <option value="Lost">I Lost This Item</option>
                        <option value="Found">I Found This Item</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Detailed Description</label>
                    <textarea id="description" name="description" rows="4" placeholder="Describe where or when the item was lost/found..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="item_image">Upload Item Photo</label>
                    <input type="file" id="item_image" name="item_image" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label for="phone">Your Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="0912345678" required>
                </div>

                <button type="submit" name="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> Submit Report
                </button>
            </form>
        </div>
    </div>

    <footer style="text-align: center; padding: 20px; color: #7f8c8d;">
        <p>&copy; 2026 Worabe University Lost & Found Portal</p>
    </footer>

</body>
</html>