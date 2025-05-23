<?php
include('constant.php');//  Database connection

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $query = "INSERT INTO tbl_users (name, email, password, phone, address, user_type) 
              VALUES ('$name', '$email', '$password', '$phone', '$address', 'customer')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('✅ Signup Successful! Please login.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('❌ Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Foodie</title>
    <link rel="stylesheet" href="auth.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        
    </style>
</head>
<body>

    <div class="container">
        <h2>Signup</h2>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="phone" placeholder="Phone" required>
            <input type="text" name="address" placeholder="Address" required>
            <button type="submit" name="submit">Signup</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

</body>
</html>
