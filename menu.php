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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* 🔥 Stylish Search Box */
        .search-box {
            display: flex;
            align-items: center;
            background: #1c1c1c;
            border: 2px solid #FFD700;
            border-radius: 30px;
            padding: 2px 15px;
            width: 300px;
            box-shadow: 0 4px 10px rgba(255, 215, 0, 0.3);
            position: relative;
        }
        .search-box input {
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            color: #FFD700;
            font-size: 16px;
            padding: 8px;
        }
        .search-box i {
            color: #FFD700;
            font-size: 22px;
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }
        
        /* 🔹 Search Results Box */
        #searchResults {
            position: absolute;
            top: 50px;
            background: #1c1c1c;
            border: 1px solid #FFD700;
            box-shadow: 0 4px 10px rgba(255, 215, 0, 0.3);
            display: none;
            border-radius: 5px;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
        }
        #searchResults div {
            padding: 10px;
            color: #FFD700;
            cursor: pointer;
        }
        #searchResults div:hover {
            background: #333;
        }

        /* 🔥 Profile Section */
        .profile-container {
            position: absolute;
            top: 10px;
            left: 20px;
            display: flex;
            align-items: center;
        }
        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            border: 3px solid blue;
            background-color: #FFD700;
            color: #1c1c1c;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
        }
        .profile-dropdown {
            position: absolute;
            top: 50px;
            left: 20px;
            background: #1c1c1c;
            border: 1px solid #FFD700;
            box-shadow: 0 4px 10px rgba(255, 215, 0, 0.3);
            display: none;
            border-radius: 5px;
            min-width: 150px;
        }
        .profile-dropdown a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #FFD700;
            font-size: 16px;
        }
        .profile-dropdown a:hover {
            background: #333;
        }
    </style>
</head>
<body>
    <nav class="nav">
        <a href="index.php" class="logo">Daily Orders</a>  
        <div class="nav-container">
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="category.php">Category</a></li>
                <li><a href="order.php">Order</a></li>
            </ul>
            
            <!-- ✅ Stylish Search Box -->
            <form class="search-box">
                <input type="text" id="searchInput" placeholder="Search Food..." onkeyup="liveSearch()">
                <i class="fas fa-search"></i>
                <div id="searchResults"></div>
            </form>

            <!-- ✅ Profile Icon with First Letter -->
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
    
    <script>
        function liveSearch() {
            const searchTerm = document.getElementById('searchInput').value.trim();
            if (searchTerm.length > 0) {
                fetch(`search.php?query=${encodeURIComponent(searchTerm)}`)
                .then(response => response.text())
                .then(data => {
                    const results = document.getElementById('searchResults');
                    results.innerHTML = data;
                    results.style.display = 'block';
                });
            } else {
                document.getElementById('searchResults').innerHTML = '';
                document.getElementById('searchResults').style.display = 'none';
            }
        }

        function selectItem(foodName) {
            document.getElementById('searchInput').value = foodName;
            document.getElementById('searchResults').innerHTML = '';
            document.getElementById('searchResults').style.display = 'none';
        }

        function toggleProfileMenu() {
            var menu = document.getElementById("profileMenu");
            menu.style.display = menu.style.display === "block" ? "none" : "block";
        }

        document.addEventListener("click", function(event) {
            var menu = document.getElementById("profileMenu");
            if (!event.target.closest(".profile-container")) {
                menu.style.display = "none";
            }
        });
    </script>
</body>
</html>
