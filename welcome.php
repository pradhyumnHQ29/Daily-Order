<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
include('index.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome - Foodie</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['user']; ?>! 🍕🍔🍟</h1>
    <p>You can now explore our delicious food menu!</p>
    <a href="logout.php">Logout</a>
</body>
</html>
