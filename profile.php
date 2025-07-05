<?php
session_start();
include('constant.php'); //  Database connection

//  Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

//  Fetch user details from database
$user_id = $_SESSION['user_id'];

$query = "SELECT name, email, address, created_at FROM tbl_users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($user_name, $user_email, $user_address, $account_created);
$stmt->fetch();
$stmt->close();

//  Store data in session
$_SESSION['user'] = $user_name;
$_SESSION['email'] = $user_email;
$_SESSION['address'] = $user_address;
$_SESSION['created_at'] = $account_created;

$first_letter = strtoupper(substr($user_name, 0, 1)); //  First letter as profile icon
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Foodie</title>
    <link rel="stylesheet" href="profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"> <!-- ✅ Font Added -->
    
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
