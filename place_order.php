<?php
session_start();
include('constant.php');       // Database connection file
include('send_email.php');     // Email sending function

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get and clean input data from the form
    $food_name = mysqli_real_escape_string($conn, $_POST['food_name']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Calculate total cost
    $total_price = $price * $quantity;

    // Prepare SQL query to add order to database
    $query = "INSERT INTO tbl_order 
        (food, price, qty, total, costomer_name, costomer_email, costomer_contact, costomer_address) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Database prepare failed: " . htmlspecialchars($conn->error));
    }

    // Attach the values to the SQL query
    $stmt->bind_param("sdidssss", 
        $food_name, 
        $price, 
        $quantity, 
        $total_price, 
        $name, 
        $email, 
        $phone, 
        $address
    );

    // Run the query to save the order
    if ($stmt->execute()) {

        // Prepare email with order details
        $subject = "🛒 New Order Placed on Daily Order!";
        $body = "
            <h3>New Order Received</h3>
            <ul>
                <li><strong>Name:</strong> {$name}</li>
                <li><strong>Email:</strong> {$email}</li>
                <li><strong>Phone:</strong> {$phone}</li>
                <li><strong>Address:</strong> {$address}</li>
                <li><strong>Food:</strong> {$food_name}</li>
                <li><strong>Quantity:</strong> {$quantity}</li>
                <li><strong>Price per Item:</strong> ₹" . number_format($price, 2) . "</li>
                <li><strong>Total Price:</strong> ₹" . number_format($total_price, 2) . "</li>
                <li><strong>Order Date:</strong> " . date("Y-m-d H:i:s") . "</li>
            </ul>
        ";

        // Send the order email
        sendCustomEmail($subject, $body);

        // Redirect to success page without alert
        $food_name_encoded = urlencode($food_name);
        $total_formatted = number_format($total_price, 2);

        echo "<script>
            window.location.href='success.php?food_name={$food_name_encoded}&quantity={$quantity}&total={$total_formatted}';
        </script>";
        exit();

    } else {
        // Show error message if order failed
        $error = addslashes($stmt->error);
        echo "<script>alert('❌ Error placing order: $error'); window.history.back();</script>";
    }

    // Close the database connections
    $stmt->close();
    $conn->close();

} else {
    //  go back to home page
    header("Location: index.php");
    exit();
}
?>
