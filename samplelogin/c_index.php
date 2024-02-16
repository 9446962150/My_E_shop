<?php
session_start();

// Include database connection
include("db.php");

$query = "SELECT * FROM products";
$product_result = mysqli_query($conn, $query);

if (!$product_result) 
    die("Database error: " . mysqli_error($conn));
?>

<html>
<head>
    <title>Your eCommerce Store</title>
    <link rel="stylesheet" type="text/css" href="stylesbard.css">
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
        <div class="search-bar">
            <form action="" method="POST">
                <input type="text" name="key" placeholder="Search for products">
                <button type="submit" name="search">Search</button>
            </form>
        </div>
	<?php
    		if(isset($_REQUEST["search"]))
			include("search.php");
		else{
	?>


        <div class="content_wrapper">
        <div id="left_sidebar">
            <div id="sidebar_title">Categories</div>
                <ul id = "cats">
            <?php 
                $sql = "SELECT cat_name FROM categories";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)){
            ?>
          <li><a href="category.php?category=<?php echo $row["cat_name"]; ?>"><?php echo $row["cat_name"]; }?></a></li>
                </ul>
        </div>
        </div>

        <section class="featured-products">
            <center> <h1> Welcome, <?php 
                if(isset($_SESSION['user']) && !empty($_SESSION['user']))
                echo $_SESSION['user'];  ?></h1>
    <h2> Products Available:</h2></center>
        <div class="tiles">
        <?php while ($product = mysqli_fetch_assoc($product_result)): ?>
                <div class="tile">
                <br><img src="./image/<?php echo $product['image1']; ?>" width="200" height="150">
                <br><center>
                <strong><?php echo $product["name"]; ?></strong>
                <br>
                Price: $<?php echo $product["price"]; ?>
                <br>
                <?php echo $product["description"]; ?>
                <br><br></center>
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
                <?php } ?>
                <a href="details.php?product_id=<?php echo $product["id"]; ?>">More</a>
                </div>
        <?php endwhile; ?>
    </div>
        </section><?php } ?>
    </main>
    
    <footer id="footer">
        <p>&copy; 2023 Your E-commerce Store. All rights reserved.</p>
        <div id="contact-info">
            Contact: support@yourstore.com | Phone: +91 9600033221
        </div>
        <div id="address">
            Main Street Erattupetta, Kottayam District , Kerala , India
        </div>
    </footer>
</body>
</html>