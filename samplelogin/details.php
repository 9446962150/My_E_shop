<?php
session_start();
include("db.php");

// Initialize a variable to store potential errors
$error = "";

    $product_id = $_GET['product_id'];

    // Perform a database query to retrieve the product details
    $query = "SELECT * FROM products WHERE id = $product_id";
    $product_result = mysqli_query($conn, $query);

    if ($product_result) {
        $product = mysqli_fetch_assoc($product_result);

        // Check if the product was found
        if (!$product) {
            $error = "Product not found.";
        }
    }
?>
<html lang="en">
<head>
    <title><?php echo $product['name']; ?> - Your eCommerce Store</title>
    <link rel="stylesheet" href="stylesbard.css">
    <link rel="stylesheet" href="detailscss.css">

</head>
<body>
    <header>
        <h1>Welcome to Your eCommerce Store</h1><br>
        <nav>
            <ul>
                <li><a href="c_index.php">Home</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="myorder.php">My orders</a></li>
                <?php
                    if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
                        echo '<li><a href="Profile.php">My Profile</a></li>';
                        echo '<li><a href="logout.php">Logout</a></li>';
		    }
                    else
                        echo '<li><a href="login.php">Login/SignUP</a></li>';
                ?>
            </ul>
        </nav>
    </header>

    <main>
        <div class="product-details">
            <div class="image-container">
                <div class="image-slider">
                    <!-- Display small thumbnail images for the product -->
                    <?php
                    for ($i = 1; $i <= 3; $i++) {
                        echo '<center><img class="product-thumbnail" src="./image/' . $product["image$i"] . '" onclick="changeImage(this)" width="50" height="50"></center>';
                    }
                    ?>
                </div>
            </div>
            <!-- Display the main product image in a larger size -->
            <img class="product-image-main" src="./image/<?php echo $product['image1']; ?>" onclick="changeImage(this)" width="300" height="350">
            <div class="product-info">
                <h2><?php echo $product['name']; ?></h2>
                <p><?php echo $product['description']; ?></p>
                <?php
                if ($product['qty'] < 0)
                    echo '<p class="low-stock">Out of Stock</p>';
                ?>
                <div class="product-price">$<?php echo $product['price']; ?></div>
            </div>
        </div>
        <div class="product-buttons">
                <?php
                $prid=$product["id"];
                $user ="";
                if(isset($_SESSION['user']) && !empty($_SESSION['user']))
                $user = $_SESSION['user'];
                $car="SELECT * FROM cart WHERE Cid=(SELECT Cid FROM customer WHERE Username='$user') AND id='$prid'";
                $ch=mysqli_query($conn, $car);
                if(mysqli_num_rows($ch)<1){
                ?>
                <a href="add_to_cart.php?product_id=<?php echo $product["id"]; ?>">Add to Cart</a><?php }
                elseif (mysqli_num_rows($ch)>0) { ?>
                <a href="cartremove.php?product_id=<?php echo $product["id"]; ?>">Remove from Cart</a>
                <?php }
                if ($product['qty'] > 0){ ?>
            <a href="buy.php?product_id=<?php echo $product_id; ?>">Buy</a><?php } ?>
            <!-- You can add more buttons or actions here -->
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Your eCommerce Store. All rights reserved.</p>
    </footer>

    <script>
        // JavaScript function to change the main image when a thumbnail is clicked
        function changeImage(element) {
            var mainImage = document.querySelector('.product-image-main');
            mainImage.src = element.src;
        }
    </script>
</body>
</html>
