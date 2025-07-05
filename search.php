<?php
// Connect to the database
include("constant.php");

// Check if search query is sent
if (isset($_GET['query'])) {
    // Escape the input to make it safe
    $searchTerm = mysqli_real_escape_string($conn, $_GET['query']);

    // SQL query to find matching food items
    $sql = "SELECT * FROM tbl_foods WHERE food_name LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $sql) or die("Query Failed: " . mysqli_error($conn));

    // If results are found
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='search-results-container'>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='food-item'>";
            
            // Show food image
            echo "<img loading='lazy' src='food-image/" . $row['image'] . "' alt='" . $row['food_name'] . "' class='food-image'>";
            
            // Show food name with yellow highlight
            echo "<h3 onclick='selectItem(\"" . $row['food_name'] . "\")'>" .
                str_ireplace($searchTerm, "<span style='background:yellow'>" . $searchTerm . "</span>", $row['food_name']) .
                "</h3>";
            
            // Show food price
            echo "<p class='price'>Price: ₹" . $row['price'] . "</p>";
            
            // "Order Now" button with link to order page
            echo "<a href='order.php?id=" . $row['id'] .
                "&food_name=" . urlencode($row['food_name']) .
                "&price=" . $row['price'] .
                "&image=" . urlencode($row['image']) . "' class='order-now'>Order Now</a>";
            
            echo "</div>";
        }
        echo "</div>";
    } else {
        // If no result found
        echo "<p style='color: red;'>No results found!</p>";
    }
}
?>

<!-- Page title and CSS -->
<title>Food Search</title>
<link rel="stylesheet" href="search.css">

<!-- JavaScript to select item and hide results -->
<script>
    function selectItem(foodName) {
        // Fill the input with selected food name
        document.getElementById('searchInput').value = foodName;
        // Clear the search results
        document.getElementById('searchResults').innerHTML = '';
    }
</script>
