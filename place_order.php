<?php
session_start();
include('constant.php'); // Database connection included

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $food = isset($_POST['food_name']) && !empty($_POST['food_name']) ? trim($_POST['food_name']) : 'Unknown';
    $price = isset($_POST['price']) && is_numeric($_POST['price']) ? floatval($_POST['price']) : 0;
    $qty = isset($_POST['quantity']) && is_numeric($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    $total = $price * $qty;
    $order_date = date("Y-m-d H:i:s");
    $status = "Pending";
    $costomer_name = isset($_POST['name']) ? trim($_POST['name']) : 'Unknown';
    $costomer_contact = isset($_POST['phone']) ? trim($_POST['phone']) : 'Not Provided';
    $costomer_email = isset($_POST['email']) ? trim($_POST['email']) : 'Not Provided';
    $costomer_address = isset($_POST['address']) ? trim($_POST['address']) : 'Not Provided';

    $query = "INSERT INTO tbl_order (food, price, qty, total, order_date, status, costomer_name, costomer_contact, costomer_email, costomer_address) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("sdidssssss", $food, $price, $qty, $total, $order_date, $status, $costomer_name, $costomer_contact, $costomer_email, $costomer_address);
        if ($stmt->execute()) {
            //  Fix: Pass the data to `success.php`
            header("Location: success.php?food_name=" . urlencode($food) . "&quantity=" . $qty . "&total=" . $total);
            exit();
        } else {
            echo "Order Failed: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error in SQL Query: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid Request!";
}
?>
