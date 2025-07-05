<?php
session_start();
include('constant.php'); //  Database Connection

//  User must be logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

//  Fetch user details from `tbl_users`
$query = "SELECT name, phone, address, email FROM tbl_users WHERE id = ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("SQL Error: " . $conn->error); // Debugging line
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $phone, $address, $email);
$stmt->fetch();
$stmt->close();

//  Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $new_name = trim($_POST['name']);
    $_phone = trim($_POST['phone']);
    $new_address = trim($_POST['address']);
    $new_email = trim($_POST['email']);

    // Update Query
    $update_query = "UPDATE tbl_users SET name = ?, phone = ?, address = ?, email = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    if (!$update_stmt) {
        die("SQL Error: " . $conn->error);
    }
    $update_stmt->bind_param("ssssi", $new_name, $_phone, $new_address, $new_email, $user_id);

    if ($update_stmt->execute()) {
        $_SESSION['user'] = $new_name;
        $_SESSION['email'] = $new_email;
        echo "<script>alert('Profile Updated Successfully!'); window.location='profile.php';</script>";
    } else {
        echo "<script>alert('Update Failed!');</script>";
    }
    $update_stmt->close();
}
?>

    <link rel="stylesheet" href="profile.css">

    <div class="edit-container">
        <h2>Edit Profile</h2>
        <form method="POST">
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
            <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <button type="submit">Save Changes</button>
        </form>
        <a href="index.php">⬅️ Back to Home</a>
   