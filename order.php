<?php
session_start();
include('constant.php'); // Database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
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

// Image Path Ensure karna
$imagePath = "food-image/" . basename($image);
if (!file_exists($imagePath)) {
    $imagePath = "food-image/default.jpg";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Now - <?php echo $foodName; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #121212;
            color: #fff;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            margin: 0;
            flex-direction: column;
            position: relative;
        }

        .top-buttons {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            gap: 10px;
        }

        .top-buttons a {
            text-decoration: none;
            background: #FFD700;
            color: #121212;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
        }

        .order-container {
            width: 100%;
            max-width: 450px;
            background: #1c1c1c;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(255, 215, 0, 0.4);
            text-align: center;
            border: 2px solid #FFD700;
            animation: fadeIn 0.8s ease-in-out;
        }

        .order-container img {
            width: 100%;
            border-radius: 12px;
            margin-bottom: 15px;
        }

        h2 { color: #FFD700; margin-bottom: 10px; }
        .price { font-size: 24px; color: #FFD700; font-weight: bold; margin-bottom: 15px; }

        .quantity-box {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            margin: 20px 0;
        }

        .quantity-box button {
            background: #FFD700;
            border: none;
            padding: 10px 15px;
            font-size: 20px;
            cursor: pointer;
            color: #121212;
            border-radius: 5px;
            transition: 0.3s;
        }

        .quantity-box input {
            width: 60px;
            text-align: center;
            font-size: 20px;
            border: 2px solid #FFD700;
            background: #1c1c1c;
            color: #FFD700;
            border-radius: 5px;
            padding: 5px;
        }

        .order-btn {
            width: 100%;
            padding: 12px;
            background: #FFD700;
            color: #121212;
            font-weight: bold;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            font-size: 18px;
            transition: 0.3s;
        }

        .order-btn:hover { background: #e6c300; transform: scale(1.05); }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="top-buttons">
    <a href="">Home</a>
    <a href="category.php">Category</a>
</div>

<div class="order-container">
    <img src="<?php echo $imagePath; ?>" alt="<?php echo $foodName; ?>">
    <h2><?php echo $foodName; ?></h2>
    <p class="price">₹<span id="totalPrice"><?php echo number_format($price, 2); ?></span></p>

    <form action="place_order.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="hidden" name="food_name" value="<?php echo $foodName; ?>">
        <input type="hidden" name="price" value="<?php echo $price; ?>">
        <input type="hidden" name="image" value="<?php echo $imagePath; ?>">

        <input type="hidden" name="name" value="<?php echo $user['name']; ?>">
        <input type="hidden" name="email" value="<?php echo $user['email']; ?>">
        <input type="hidden" name="phone" value="<?php echo $user['phone']; ?>">
        <input type="hidden" name="address" value="<?php echo $user['address']; ?>">

        <div class="quantity-box">
            <button type="button" onclick="changeQuantity(-1)">-</button>
            <input type="number" name="quantity" id="quantity" value="1" min="1" readonly>
            <button type="button" onclick="changeQuantity(1)">+</button>
        </div>

        <button type="submit" class="order-btn">Proceed to Payment</button>
    </form>
</div>

<script>
    let pricePerItem = <?php echo $price; ?>;

    function changeQuantity(amount) {
        let quantityInput = document.getElementById('quantity');
        let newQuantity = parseInt(quantityInput.value) + amount;
        if (newQuantity >= 1) {
            quantityInput.value = newQuantity;
            document.getElementById('totalPrice').innerText = (pricePerItem * newQuantity).toFixed(2);
        }
    }
</script>

</body>
</html>