<?php
include("constant.php");

if(isset($_GET['query'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['query']);

    $sql = "SELECT * FROM tbl_category WHERE food_name LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $sql) or die("Query Failed: " . mysqli_error($conn));

    if(mysqli_num_rows($result) > 0) {
        echo "<div class='search-results-container'>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<div class='food-item'>";
            echo "<img src='food-image/" . $row['image'] . "' alt='" . $row['food_name'] . "' class='food-image'>"; 
            echo "<h3 onclick='selectItem(\"" . $row['food_name'] . "\")'>" . 
                 str_ireplace($searchTerm, "<span style='background:yellow'>" . $searchTerm . "</span>", $row['food_name']) . 
                 "</h3>";
            echo "<p class='price'>Price: ₹" . $row['price'] . "</p>";
            echo "<a href='order.php?id=" . $row['id'] . 
                 "&food_name=" . urlencode($row['food_name']) . 
                 "&price=" . $row['price'] . 
                 "&image=" . urlencode($row['image']) . "' class='order-now'>Order Now</a>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p style='color: red;'>No results found!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Food Search</title>
    <style>
        body {
            background: #121212;
            color: #fff;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }

        .search-results-container {
            display: inline;
            height: 20px;
           
        }

        .food-item {
    background: #1c1c1c;
    border: 2px solid #FFD700;
    border-radius: 2px;
    padding: 30px;
    box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
    margin-top: 5%;        /* Food items ke beech gap */
    
}

        .food-item:hover {
            transform: scale(1.05);
        }

        .food-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .price {
            color: #FFD700;
            font-weight: bold;
        }

        .order-now {
            display: inline-block;
            background: #FFD700;
            color: #121212;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .order-now:hover {
            background: #e6c300;
            transform: scale(1.1);
        }
    </style>
</head>
<body>

<script>
    function selectItem(foodName) {
        document.getElementById('searchInput').value = foodName;
        document.getElementById('searchResults').innerHTML = '';
    }
</script>

</body>
</html>
