<?php 
   session_start();
   include("constant.php");

   // Extract first letter of username
   $user_name = isset($_SESSION['user']) ? $_SESSION['user'] : "Guest";
   $first_letter = strtoupper(substr($user_name, 0, 1));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order Website - Home</title>
    <link rel="stylesheet" href="menu.css">
</head>
<body>
    <nav class="nav">
        <a href="index.php" class="logo">Daily Orders</a>  
        <div class="nav-container">
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="foods.php">Foods</a></li>
                <li><a href="order.php">Order</a></li>
            </ul>
            
            <!-- Stylish Search Box -->
            <form class="search-box">
                <input type="text" id="searchInput" placeholder="Search Food..." onkeyup="liveSearch()">
                <i class="fas fa-search"></i>
                <div id="searchResults"></div>
            </form>

            <!-- Profile Icon with First Letter -->
            <div class="profile-container">
                <div class="profile-icon" onclick="toggleProfileMenu()">
                    <?php echo $first_letter; ?>
                </div>
                <div class="profile-dropdown" id="profileMenu">
                    <a href="profile.php">View Profile</a>
                    <a href="setting.php">Setting</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    
    <script src="manu.js" defer></script>
</body>
</html>
