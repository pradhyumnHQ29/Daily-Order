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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <style>
        body {
            background: #F9F9F9;
            color: #333;
            font-family: 'Poppins', sans-serif;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #E3F2FD;
            border: 2px solid #BBDEFB;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 15px;
            width: 400px;
            animation: fadeIn 1s ease-in-out;
            position: relative;
        }
        .success-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #4CAF50;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
            animation: spin 1s ease-in-out forwards;
        }
        .success-icon::after {
            content: '✔';
            font-size: 40px;
            color: white;
            font-weight: bold;
            opacity: 0;
            animation: fadeInTick 1s ease-in-out 0.5s forwards;
        }
        .order-box {
            background: #ffffff;
            border: 2px solid #BBDEFB;
            padding: 15px;
            margin-top: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn {
            background: #4CAF50;
            color: white;
            font-size: 16px;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: bold;
            border-radius: 8px;
            margin-top: 15px;
            transition: all 0.3s ease-in-out;
        }
        .btn:hover {
            background: #45A049;
            transform: scale(1.1);
            box-shadow: 0 0 10px #4CAF50;
        }
        @keyframes spin {
            0% { transform: rotate(0deg) scale(0); opacity: 0; }
            100% { transform: rotate(360deg) scale(1); opacity: 1; }
        }
        @keyframes fadeInTick {
            0% { opacity: 0; transform: scale(0.5); }
            100% { opacity: 1; transform: scale(1); }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
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
        <a href="" class="btn">🏠 Go Back to Home</a>
    </div>
    <script>
        window.onload = function() {
            document.getElementById("successSound").play();
            setTimeout(() => {
                alert("🎉 Your order has been successfully placed! Thank you for ordering.");
            }, 1000);
        };
    </script>
</body>
</html>