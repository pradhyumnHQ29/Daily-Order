<?php 
    include('menu.php'); 
    include('constant.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Orders - Home</title>

    <!-- External CSS -->
    <link rel="stylesheet" href="navbar.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Optional: Google Fonts, etc -->
</head>
<body>


    <!-- ✅ Preloader Section -->
    <div id="preloader">
        <div class="loader-container">
            <img loading='lazy'  src="logo2.png" alt="Daily Orders" class="loader-logo">
            <h1 class="loader-text">Daily Orders</h1>
        </div>
    </div>

 
 <!-- Background Video -->
 <video autoplay muted loop class="bg-video">
    <source src="video home/WhatsApp Video 2025-04-18 at 19.55.21_d24dc517.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>
    <!-- ✅ Hero Section -->
    <header class="hero">
        <div class="hero-text">
            <h1 id="typing-text" class="loader-text"></h1>
            <h1 class="loader-text">Delicious Food at Your Doorstep</h1>
            <p>Order fresh & tasty food anytime, anywhere.</p>
            <a href="foods.php" class="btn">Order Now</a>
        </div>
    </header>
<div>
    <!-- ✅ Categories Section -->
    <section class="categories">
        <h2>Explore Our Categories</h2>

        <div class="category-container" id="category-container">
            <?php
            $sql = "SELECT food_name, image FROM tbl_foods"; 
            $res = mysqli_query($conn, $sql);

            if ($res && mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $name = htmlspecialchars($row['food_name']);
                    $img = !empty($row['image']) ? 'food-image/' . $row['image'] : 'food-image/no-image.png';

                    echo "
                    <div class='category'>
                        <a href='foods.php'><img src='$img' alt='$name'></a>
                        <p>" . ucfirst($name) . "</p>
                    </div>";
                }
            } else {
                echo "<p>No food available.</p>";
            }
            ?>
        </div>

        <!-- Slide Buttons -->
        <button onclick="slideLeft()">◀</button>
        <button onclick="slideRight()">▶</button>
    </section>

    <hr>

    <!-- ✅ Footer -->
    <footer>
        <p>&copy; 2025 Foodie | Designed with ❤️</p>
    </footer>

    <?php include('footer.php'); ?>

    <!-- ✅ Scripts -->
    <script src="navbar.js" defer></script>
</body>
</html>
