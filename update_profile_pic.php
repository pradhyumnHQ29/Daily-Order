<?php
session_start();
include('constant.php');

if (!isset($_SESSION['user'])) {
    echo "error";
    exit();
}

if (isset($_POST['image'])) {
    $email = $_SESSION['email'];
    $new_image = $_POST['image'];

    // ✅ Update Database
    $query = "UPDATE tbl_users SET profile_image='$new_image' WHERE email='$email'";
    if (mysqli_query($conn, $query)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
