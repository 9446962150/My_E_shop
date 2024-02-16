<?php

// Include database connection
include("db.php");

// Check if the search form was submitted
if (isset($_POST['search'])) {
    // Sanitize user input
    $searchQuery = mysqli_real_escape_string($conn, $_POST['key']);

    // SQL query to search for products matching the query
    $query = "SELECT * FROM products WHERE (name LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%')";
    $search_result = mysqli_query($conn, $query);

    if (!$search_result) {
        die("Database error: " . mysqli_error($conn));
    }
}
?>

<html>
<head>
</head>
<body>
        <section class="search-results">
            <center><h1>Search Results for "<?php echo $searchQuery; ?>"</h1></center>
            <div class="tiles">
                <?php
                if (isset($search_result)) {
                    if(mysqli_num_rows($search_result)<1)
                        echo '<center><p>No results found.</p></center>';
                    while ($product = mysqli_fetch_assoc($search_result)) {
                        echo '<div class="tile">';
                        echo '<img src="./image/' . $product['image1'] . '" width="200" height="150">';
                        echo '<strong>' . $product["name"] . '</strong>';
                        echo '<br>Price: $' . $product["price"];
                        echo '<br>' . $product["description"];
                        echo '<br><a href="add_to_cart.php?product_id=' . $product["id"] . '">Add to Cart</a>';
                        echo '<a href="details.php?product_id=' . $product["id"] . '">More</a>';
                        echo '</div>';
                    }
                } 
                ?>
            </div>
        </section>
    </main>
</body>
</html>
