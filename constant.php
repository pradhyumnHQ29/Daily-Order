<?php 

// Constants ko dobara define hone se rokne ke liye `defined()` ka use karein
if (!defined('SITEURL')) {
    define('SITEURL', 'http://localhost//');
}
if (!defined('LOCALHOST')) {
    define('LOCALHOST', '127.0.0.1:3307');
}
if (!defined('DB_USERNAME')) {
    define('DB_USERNAME', 'root');
}
if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', '2005');
}
if (!defined('DB_NAME')) {
    define('DB_NAME', 'food_order');
}

// Establish connection
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select database
$db_select = mysqli_select_db($conn, DB_NAME);

// Check if database is selected
if (!$db_select) {
    die("Database selection failed: " . mysqli_error($conn));
}
?>


