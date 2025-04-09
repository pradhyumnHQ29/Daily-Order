<?php include('menu.php'); ?>
<?php
include('constant.php'); // Database connection ensure karein

// Query to fetch food items
$query = "SELECT food_name, price, description, image FROM tbl_category";
$result = mysqli_query($conn, $query);

// Agar query fail hoti hai to error show karein
if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Food Menu</title>
    <style>
        body { font-family: Arial, sans-serif; background: #121212; color: #fff; }
        .container { width: 80%; margin: auto; text-align: center; }
        .food-box { display: inline-block; width: 300px; margin: 20px; background: #1a1a1a; padding: 15px; border-radius: 10px; box-shadow: 0px 5px 15px rgba(255, 215, 0, 0.2); transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .food-box:hover { transform: scale(1.05); box-shadow: 0px 5px 20px rgba(255, 215, 0, 0.4); }
        img { width: 100%; height: 200px; object-fit: cover; border-radius: 10px; }
        h2 { color: #ffd700; font-size: 22px; }
        .price { font-size: 20px; color: #ffcc00; font-weight: bold; }
        .description { font-size: 14px; color: #bbb; margin: 10px 0; }
        .order-btn { display: inline-block; background: #ffd700; color: #000; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-weight: bold; transition: background 0.3s ease, transform 0.3s ease; }
        .order-btn:hover { background: #ffcc00; transform: scale(1.1); }
        .cart-icon { position: fixed; top: 20px; right: 20px; background: #ffd700; padding: 15px; border-radius: 50%; box-shadow: 0px 5px 10px rgba(255, 215, 0, 0.3); cursor: pointer; transition: transform 0.3s ease; }
        .cart-icon:hover { transform: scale(1.1); }
    </style>
</head>
<body>

<div class="container">
    <h1 style="color: #ffd700;">Our Food Menu</h1>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='food-box'>";

            // Correct Image Path
            if (!empty($row['image'])) {
                echo "<img src='food-image/" . $row['image'] . "' alt='" . htmlspecialchars($row['food_name']) . "'>";
            } else {
                echo "<img src='food-image/no-image.png' alt='No Image Available'>";
            }

            echo "<h2>" . ucfirst(htmlspecialchars($row['food_name'])) . "</h2>";
            echo "<p class='price'>₹" . number_format($row['price'], 2) . "</p>";
            echo "<p class='description'>" . htmlspecialchars($row['description']) . "</p>";

            // Order button with dynamic link
            echo "<a href='order.php?food_name=" . urlencode($row['food_name']) . 
                 "&price=" . urlencode($row['price']) . 
                 "&image=" . urlencode($row['image']) . "' class='order-btn'>Order Now</a>";

            echo "</div>";
        }
    } else {
        echo "<p>No food items found.</p>";
    }
    ?>
</div>

<div class="cart-icon">🛒</div>

</body>
</html>
<?php include('footer.php'); ?>
