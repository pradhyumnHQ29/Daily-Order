<?php
session_start();
include('constant.php'); // ✅ Database connection

// ✅ Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// ✅ Fetch user details from database
$user_id = $_SESSION['user_id'];

$query = "SELECT name, email, address, created_at FROM tbl_users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($user_name, $user_email, $user_address, $account_created);
$stmt->fetch();
$stmt->close();

// ✅ Store data in session
$_SESSION['user'] = $user_name;
$_SESSION['email'] = $user_email;
$_SESSION['address'] = $user_address;
$_SESSION['created_at'] = $account_created;

$first_letter = strtoupper(substr($user_name, 0, 1)); // 🔵 First letter as profile icon
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Foodie</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"> <!-- ✅ Font Added -->
    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }
        .profile-container {
            background: #1c1c1c;
            border: 2px solid #FFD700;
            border-radius: 15px;
            padding: 30px;
            width: 350px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
        }
        .profile-pic {
            width: 90px;
            height: 90px;
            background-color: #FFD700;
            color: #1c1c1c;
            font-size: 36px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 15px;
            text-transform: uppercase;
            box-shadow: 0px 4px 8px rgba(255, 215, 0, 0.4);
        }
        .profile-container h2 {
            font-weight: 600;
            margin-bottom: 8px;
        }
        .profile-container p {
            font-weight: 300;
            margin: 5px 0;
            font-size: 14px;
        }
        .profile-container a {
            color: #FFD700;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 15px;
            display: inline-block;
            border: 1px solid #FFD700;
            border-radius: 5px;
            margin-top: 10px;
            transition: 0.3s;
        }
        .profile-container a:hover {
            background: #FFD700;
            color: #1c1c1c;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-pic"><?php echo $first_letter; ?></div>
        <h2><?php echo htmlspecialchars($user_name); ?></h2>
        <p>📧 <?php echo htmlspecialchars($user_email); ?></p>
        <p>🏠 <?php echo htmlspecialchars($user_address ?? "No Address Provided"); ?></p> 
        <p>📅 Account Created: <strong><?php echo date("d M Y", strtotime($account_created)); ?></strong></p>

        <a href="edit_profile.php">✏️ Edit Profile</a> 
        <a href="logout.php">🚪 Logout</a>
        <a href="index.php">⬅️ Back to Home</a>
    </div>
</body>
</html>
