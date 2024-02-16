<?php
session_start();

// Include database connection
include("db.php");

// Get the category ID from the URL
$cat = $_GET['category'];

// Get all products in the category
$query = "SELECT * FROM products WHERE cat_name = '$cat'";
$cat_result = mysqli_query($conn, $query);

if (!$cat_result)
  die("Database error: " . mysqli_error($conn));
?>

<html>
<head>
  <title>Your eCommerce Store</title>
  <link rel="stylesheet" href="stylesbard.css">
<style>
    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
    }

    footer {
        background-color: #333; /* Set your preferred background color */
        color: #fff; /* Set your preferred text color */
        padding: 10px;
        text-align: center;
    }

</style>
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
      <form action="" method="GET">
        <input type="text" name="search" placeholder="Search for products">
        <button type="submit">Search</button>
      </form>
    </div>


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
      <center><h2><?php 
      if(mysqli_num_rows($cat_result)<1)
        echo "No Products in this category ";
      else{
        echo $cat; ?> Products Available :</h2></center>
    <div class="tiles">
    <?php while ($product = mysqli_fetch_assoc($cat_result)): ?>
        <div class="tile">
        <br><img src="./image/<?php echo $product['image1']; ?>" width="200" height="150">
        <br>
        <strong><?php echo $product["name"]; ?></strong>
        <br>
        Price: $<?php echo $product["price"]; ?>
        <br>
        Description: <?php echo $product["description"]; ?>
        <br>
        <a href="add_to_cart.php?product_id=<?php echo $product["id"]; ?>">Add to Cart</a>
        <a href="details.php?product_id=<?php echo $product["id"]; ?>">More</a>
        </div>
    <?php endwhile; }?>
  </div>
    </section>
  </main>
   
  <footer id="footer">
    <p>&copy; <?php echo date("Y"); ?> Your eCommerce Store. All rights reserved.</p>
  </footer>
</body>
</html>