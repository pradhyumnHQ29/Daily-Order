<?php
session_start();
include('constant.php'); // Database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}

// Fetch logged-in user data
$user_id = $_SESSION['user_id'];
$query = "SELECT name, email, phone, address FROM tbl_users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Fetch Food Data from URL
$foodName = isset($_GET['food_name']) ? htmlspecialchars(trim($_GET['food_name'])) : "Food Item";
$price = isset($_GET['price']) && is_numeric($_GET['price']) ? floatval($_GET['price']) : 0;
$image = isset($_GET['image']) ? htmlspecialchars(trim($_GET['image'])) : "default.jpg";

// Image Path Ensure
$imagePath = "food-image/" . basename($image);
if (!file_exists($imagePath)) {
    $imagePath = "food-image/default.jpg";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Order Now - <?php echo $foodName; ?></title>
    <link rel="stylesheet" href="order.css" />
</head>
<body>

<div class="top-buttons">
    <a href="index.php">Home</a>
    <a href="foods.php">Foods</a>
</div>

<div class="order-container">
    <img loading='lazy' src="<?php echo $imagePath; ?>" alt="<?php echo $foodName; ?>" />
    <h2><?php echo $foodName; ?></h2>
    <p class="price">₹<span id="totalPrice"><?php echo number_format($price, 2); ?></span></p>

    <!-- Form sends data to place_order.php -->
    <form action="place_order.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
        <input type="hidden" name="food_name" value="<?php echo $foodName; ?>" />
        <input type="hidden" name="price" value="<?php echo $price; ?>" />
        <input type="hidden" name="image" value="<?php echo $imagePath; ?>" />

        <input type="hidden" name="name" value="<?php echo $user['name']; ?>" />
        <input type="hidden" name="email" value="<?php echo $user['email']; ?>" />
        <input type="hidden" name="phone" value="<?php echo $user['phone']; ?>" />
        <input type="hidden" name="address" value="<?php echo $user['address']; ?>" />

        <p>Quantity</p>
        <div class="quantity-box">
            <button type="button" onclick="changeQuantity(-1)">-</button>
            <input type="number" name="quantity" id="quantity" value="1" min="1" readonly />
            <button type="button" onclick="changeQuantity(1)">+</button>
        </div>

        <button  type="submit" class="order-btn" >Proceed to Payment</button>
    </form>
</div>

<script>
    const pricePerItem = <?php echo $price; ?>;
    function changeQuantity(delta) {
        let qtyInput = document.getElementById('quantity');
        let current = parseInt(qtyInput.value);
        let next = current + delta;
        if (next >= 1) {
            qtyInput.value = next;
            document.getElementById('totalPrice').innerText = (pricePerItem * next).toFixed(2);
        }
    }
</script>

</body>
</html>
