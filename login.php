<?php
session_start(); // Start the session to store user data
include('constant.php'); // Include the database connection file

$error = ""; // Variable to store error messages

// If the user is already logged in, redirect them
if (isset($_SESSION['user_id'])) {
    header('Location: '); // Add the redirect URL here
    exit();
}

// If the form is submitted and the login button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Sanitize email and password input
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $password = trim(mysqli_real_escape_string($conn, $_POST['password']));

    // Query to check if the email exists in the database
    $query = "SELECT * FROM tbl_users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    // If there’s an error in the query, stop and show the error
    if (!$result) {
        die("❌ Error in SQL Query: " . mysqli_error($conn));
    }

    // If user found with the given email
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result); // Fetch user data

        // Verify the entered password with the hashed password in DB
        if (password_verify($password, $row['password'])) {
            // If password is correct, set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['user_type'] = $row['user_type'];

            // Redirect based on user type
            if ($row['user_type'] === 'admin') {
                header('Location: admin_dashboard.php'); // For Admin
            } else {
                header('Location: index.php'); // For Regular User
            }
            exit();
        } else {
            $error = "❌ Incorrect Password!"; // If password doesn’t match
        }
    } else {
        $error = "❌ User Not Found!"; // If email not found in database
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Daily Order</title>
    <link rel="stylesheet" href="auth.css"> <!-- Link to CSS file -->
</head>
<body class="login-page">
    <div class="login-box">
        <h2>🍔 Login to Daily Order</h2>

        <!-- Show error message if any -->
        <?php if (!empty($error)): ?>
            <p class="login-error"><?php echo $error; ?></p>
        <?php endif; ?>

        <!-- Login form -->
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" class="login-input" required><br>
            <input type="password" name="password" placeholder="Password" class="login-input" required><br>
            <button type="submit" name="login" class="login-button">Login</button>
        </form>

        <!-- Link to signup page for new users -->
        <p class="login-text">New User? <a href="signup.php" class="login-link">Signup here</a></p>
    </div>
</body>
</html>
