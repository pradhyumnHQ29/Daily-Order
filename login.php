<?php
session_start();
include('constant.php'); // ✅ Database Connection Include

$error = ""; // ✅ Error Message Variable

// ✅ Agar user already login hai to redirect karna
if (isset($_SESSION['user_id'])) {
    header('Location: ');
    exit();
}

// ✅ Form Data Handle Karna
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $password = trim(mysqli_real_escape_string($conn, $_POST['password']));

    // ✅ Query to Check Email
    $query = "SELECT * FROM tbl_users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    // ✅ Error Handling for SQL Query
    if (!$result) {
        die("❌ Error in SQL Query: " . mysqli_error($conn));
    }

    // ✅ User Check
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // ✅ Password Verification
        if (password_verify($password, $row['password'])) {
            // ✅ Session Data Set Karna
            $_SESSION['user_id'] = $row['id'];  // ✅ User ID Store
            $_SESSION['user'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['user_type'] = $row['user_type'];

            // ✅ Redirect Based on User Type
            if ($row['user_type'] === 'admin') {
                header('Location: admin_dashboard.php'); // Admin ke liye
            } else {
                header('Location: index.php'); // Regular User ke liye
            }
            exit();
        } else {
            $error = "❌ Incorrect Password!";
        }
    } else {
        $error = "❌ User Not Found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Foodie</title>
    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: #1c1c1c;
            border: 2px solid #FFD700;
            border-radius: 15px;
            padding: 30px;
            width: 350px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #FFD700;
            background: transparent;
            color: #FFD700;
            border-radius: 5px;
            outline: none;
        }
        button {
            background-color: #FFD700;
            color: #121212;
            cursor: pointer;
            font-weight: bold;
        }
        a {
            color: #FFD700;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>🍔 Login to Foodie</h2>
        
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="login">Login</button>
        </form>
        <p>New User? <a href="signup.php">Signup here</a></p>
    </div>
</body>
</html>
