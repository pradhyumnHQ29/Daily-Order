<?php
$foodName = isset($_GET['food_name']) ? htmlspecialchars($_GET['food_name']) : "Unknown";
$quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1;
$total = isset($_GET['total']) ? number_format(floatval($_GET['total']), 2) : "0.00";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎉 Order Success 🎉</title>
    <link rel="stylesheet" href="order.css">
   
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <style>
        
    </style>
</head>
<body class="success-page">
    <audio id="successSound" autoplay>
        <source src="success.mp3" type="audio/mpeg">
    </audio>
    <div class="container">
        <div class="success-icon"></div>
        <h1>🎉 Order Placed Successfully! 🎉</h1>
        <div class="order-box">
            <p><strong>🍽 Food Item:</strong> <?php echo $foodName; ?></p>
            <p><strong>🔢 Quantity:</strong> <?php echo $quantity; ?></p>
            <p><strong>💰 Total Paid:</strong> ₹<?php echo $total; ?></p>
        </div>
        <a href="index.php" class="btn">🏠 Go Back to Home</a>
    </div>
    <script >
        
        window.onload = function() {
            document.getElementById("successSound").play();
            setTimeout(() => {
                alert("🎉 Your order has been successfully placed! Thank you for ordering.");
            }, 1000);
        };
    </script>
</body>
</html>