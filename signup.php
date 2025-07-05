<?php
include('constant.php');     // DB connection
include('send_email.php');   // Email function

if (isset($_POST['submit'])) {
    // Sanitize & validate inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Check if email already exists (optional but recommended)
    $checkQuery = "SELECT id FROM tbl_users WHERE email = ?";
    $stmtCheck = $conn->prepare($checkQuery);
    $stmtCheck->bind_param("s", $email);
    $stmtCheck->execute();
    $stmtCheck->store_result();
    if ($stmtCheck->num_rows > 0) {
        echo "<script>alert('❌ Email already registered! Please use a different email.');</script>";
    } else {
        // Insert user into DB
        $query = "INSERT INTO tbl_users (name, email, password, phone, address, user_type) VALUES (?, ?, ?, ?, ?, 'customer')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $name, $email, $password, $phone, $address);

        if ($stmt->execute()) {
            // Prepare email to admin
            $subject = "🆕 New User Signed Up - Foodie";
            $body = "
                <h3>New User Signup Details:</h3>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Phone:</strong> {$phone}</p>
                <p><strong>Address:</strong> {$address}</p>
                <p><strong>Signup Time:</strong> " . date('Y-m-d H:i:s') . "</p>
            ";

            // Send email notification to admin
            sendCustomEmail($subject, $body);

            echo "<script>alert('✅ Sign-up Successful! Please login.'); window.location.href='login.php';</script>";
            exit();
        } else {
            $error = addslashes($stmt->error);
            echo "<script>alert('❌ Error: $error');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Signup - Foodie</title>
    <link rel="stylesheet" href="auth.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <h2>Signup</h2>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Full Name" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="text" name="phone" placeholder="Phone" required />
            <input type="text" name="address" placeholder="Address" required />
            <button type="submit" name="submit">Signup</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
