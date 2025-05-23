<?php
session_start();
include('constant.php'); //  Database connection

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

// Change Password
if (isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    //  Fetch existing password
    $query = "SELECT password FROM tbl_users WHERE id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        $stmt->close();

        //  Verify current password
        if (password_verify($current_password, $hashed_password)) {
            if ($new_password === $confirm_password) {
                // Hash new password
                $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                
                // Update password
                $update_query = "UPDATE tbl_users SET password = ? WHERE id = ?";
                if ($stmt = $conn->prepare($update_query)) {
                    $stmt->bind_param("si", $new_hashed_password, $user_id);
                    if ($stmt->execute()) {
                        $message = "✅ Password changed successfully!";
                    } else {
                        $message = "❌ Error updating password.";
                    }
                    $stmt->close();
                }
            } else {
                $message = "❌ New passwords do not match!";
            }
        } else {
            $message = "❌ Current password is incorrect!";
        }
    } else {
        $message = "❌ Database error: " . $conn->error;
    }
}

//  Toggle Two-Factor Authentication
if (isset($_POST['toggle_2fa'])) {
    $two_factor_enabled = isset($_POST['two_factor']) ? 1 : 0;

    $update_2fa = "UPDATE tbl_users SET two_factor_enabled = ? WHERE id = ?";
    if ($stmt = $conn->prepare($update_2fa)) {
        $stmt->bind_param("ii", $two_factor_enabled, $user_id);
        if ($stmt->execute()) {
            $message = $two_factor_enabled ? "✅ Two-Factor Authentication Enabled!" : "✅ Two-Factor Authentication Disabled!";
        } else {
            $message = "❌ Error updating settings.";
        }
        $stmt->close();
    } else {
        die("❌ Query Preparation Failed: " . $conn->error);
    }
}

//  Delete Account
if (isset($_POST['delete_account'])) {
    $delete_query = "DELETE FROM tbl_users WHERE id = ?";
    if ($stmt = $conn->prepare($delete_query)) {
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            session_destroy();
            header('Location: goodbye.php');
            exit();
        } else {
            $message = "❌ Error deleting account.";
        }
        $stmt->close();
    } else {
        die("❌ Query Preparation Failed: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Settings - Foodie</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="settings-container">
        <h2>⚙️ Settings</h2>
        
        <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>

        <!--  Change Password -->
        <form method="POST">
            <h3>🔑 Change Password</h3>
            <input type="password" name="current_password" placeholder="Current Password" required>
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
            <button type="submit" name="change_password">Update Password</button>
        </form>

        <!--  Two-Factor Authentication -->
        <form method="POST">
            <h3>🔐 Two-Factor Authentication</h3>
            <label>
                Enable 2FA:
                <input type="checkbox" name="two_factor" value="1">
            </label>
            <button type="submit" name="toggle_2fa">Update 2FA</button>
        </form>

        <!--  Delete Account -->
        <form method="POST" onsubmit="return confirm('❗ Are you sure you want to delete your account? This action is irreversible!');">
            <h3>🚨 Delete Account</h3>
            <button type="submit" name="delete_account" class="delete-btn">Delete My Account</button>
        </form>

        <br>
        <a href="profile.php">⬅️ Back to Profile</a>
    </div>
</body>
</html>
