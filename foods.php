<?php include('menu.php'); ?> <!-- This will show the top menu bar -->

<?php
include('constant.php'); // Connect to the database

// Query to get food items from the database
$query = "SELECT food_name, price, description, image FROM tbl_foods";
$result = mysqli_query($conn, $query);

// If the query fails, show error
if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Food Menu</title>
    <link rel="stylesheet" href="navbar.css"> <!-- Link to CSS for menu bar style -->
</head>
<body>

<div class="container">
    <h1 style="color: #ffd700;">Our Food Menu</h1>

    <?php
    // Check if there are food items in the database
    if (mysqli_num_rows($result) > 0) {
        // Loop through each food item
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='food-box'>";

            // Show food image, if available
            if (!empty($row['image'])) {
                echo "<img loading='lazy' src='food-image/" . $row['image'] . "' alt='" . htmlspecialchars($row['food_name']) . "'>";
            } else {
                echo "<img loading='lazy' src='food-image/no-image.png' alt='No Image Available'>";
            }

            // Show food name, price and description
            echo "<h2>" . ucfirst(htmlspecialchars($row['food_name'])) . "</h2>";
            echo "<p class='price'>₹" . number_format($row['price'], 2) . "</p>";
            echo "<p class='description'>" . htmlspecialchars($row['description']) . "</p>";

            // Order button with food details in URL
            echo "<a href='order.php?food_name=" . urlencode($row['food_name']) . 
                 "&price=" . urlencode($row['price']) . 
                 "&image=" . urlencode($row['image']) . "' class='order-btn'>Order Now</a>";

            echo "</div>";
        }
    } else {
        // If no food items found
        echo "<p>No food items found.</p>";
    }
    ?>
</div>

</body>
</html>

<?php include('footer.php'); ?> <!-- This will show the footer -->
