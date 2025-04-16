<?php include('menu.php'); ?>
<?php include('constant.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Preloader -->
<div id="preloader">
    <div class="loader-container">
        <img src="logo.webp" alt="Daily Orders" class="loader-logo">
        <h1 class="loader-text">Daily Orders</h1>
    </div>
</div>

<!-- Hero Section -->
<header class="hero">
    <div class="hero-text">
        <h1>Delicious Food at Your Doorstep</h1>
        <p>Order fresh & tasty food anytime, anywhere.</p>
        <a href="foods.php" class="btn">Order Now</a>
    </div>
</header>

<!-- Categories Section -->
<section class="categories">
    <h2>Explore Our Categories</h2>

    <!-- Slide Buttons -->
    

    <div class="category-container" id="category-container">
        <?php
        $sql = "SELECT food_name, image FROM tbl_foods"; // Fetch all foods
        $res = mysqli_query($conn, $sql);

        if ($res && mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $name = htmlspecialchars($row['food_name']);
                $img = !empty($row['image']) ? 'food-image/' . $row['image'] : 'food-image/no-image.png';

                echo "
                <div class='category'>
                    <a href='Foods'><img src='$img' alt='$name'></a>
                    <p>" . ucfirst($name) . "</p>
                </div>";
            }
        } else {
            echo "<p>No food available.</p>";
        }
        ?>
    </div>

    <button onclick="slideLeft()">◀</button>
<button onclick="slideRight()">▶</button>

</section>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Foodie | Designed with ❤️</p>
</footer>

<?php include('footer.php'); ?>

<!-- Link CSS & JS -->
<link rel="stylesheet" href="navbar.css">

<script src="navbar.js" defer></script>

</html>