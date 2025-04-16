<?php 

// Site URL
if (!defined('SITEURL')) {
    define('SITEURL', 'http://localhost//');
}

// DB host
if (!defined('LOCALHOST')) {
    define('LOCALHOST', '127.0.0.1:3307');
}

// DB username
if (!defined('DB_USERNAME')) {
    define('DB_USERNAME', 'root');
}

// DB password
if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', '2005');
}

// DB name
if (!defined('DB_NAME')) {
    define('DB_NAME', 'food_order');
}

// Connect to DB
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select DB
$db_select = mysqli_select_db($conn, DB_NAME);

// Check DB selected
if (!$db_select) {
    die("Database selection failed: " . mysqli_error($conn));
}
?>
