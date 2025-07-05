<?php
$foodName = isset($_GET['food_name']) ? htmlspecialchars($_GET['food_name']) : "Unknown";
$quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1;
$total = isset($_GET['total']) ? number_format(floatval($_GET['total']), 2) : "0.00";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>🎉 Order Success 🎉</title>
    <link rel="stylesheet" href="order.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap"
    />
</head>
<body class="success-page">

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

</body>
</html>
