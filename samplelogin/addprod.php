<?php
session_start();
    include("db.php");
if (!isset($_SESSION['auser']) || empty($_SESSION['auser'])) {
    echo "<script>window.open('login.php', '_self')</script>";
    exit;
}
?>

<html>
<head>
    <title>Add Products</title>
    <link rel="stylesheet"  href="style_adm.css">
    <link rel="stylesheet"  href="style_adm2.css">
</head>
<body>
    <header>
        <h1>Welcome to the Admin Panel</h1></br>
        <nav>
           <nav>
            <ul>
                <li><a href="admin_index.php">Dashboard</a></li>
                <li><a href="viewallcust.php">View Customers</a></li>
                <li><a href="viewprod.php">View Products</a></li>
                <li><a href="orders.php">Manage Orders</a></li>
                <li><a href="admlogout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard">
<div class="container">
    <div class="login-container">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                Product Name: <input type="text" name="Pname" placeholder="Product Name" required>
            </div>
            <div class="form-group">
                Price: <input type="int" name="price" placeholder="Product price" required>
            </div>
            <div class="form-group">
                Description: <input type="text" name="Des" placeholder="Description" required>
            </div>
            <div class="form-group">
                Category: <select name="cat">
                <?php 
                  $sql = "SELECT cat_name FROM categories";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_array($result)){
                ?>
                <option value="<?php echo $row['cat_name']; ?>"><?php echo $row['cat_name']; }?>
                </option>
                </select>
                <a href="addcategory.php">Click to create category</a>
            </div>
            <div class="form-group">
                Quantity: <input type="number" name="qty" placeholder="Number of items" min="0" required>
            </div>
            <div class="form-group">
                Image1: <input type="file" name="img1" accept="image/*" required>
            </div>
            <div class="form-group">
                Image2: <input type="file" name="img2" accept="image/*" required>
            </div>
            <div class="form-group">
                Image3: <input type="file" name="img3" accept="image/*" required>
            </div>
            <br>
            <button type="submit" name="upload">Add</button>
        </form>
<?php
$msg = "";

if (isset($_POST['upload'])) {
    
    $pname = $_POST['Pname'];
    $price = $_POST['price'];
    $Des = $_POST['Des'];
    $qty = $_POST['qty'];
    $cat=$_REQUEST['cat'];

    $product_img1 = $_FILES['img1']['name'];
    $product_img2 = $_FILES['img2']['name'];
    $product_img3 = $_FILES['img3']['name'];

    $temp_name1 = $_FILES['img1']['tmp_name'];
    $temp_name2 = $_FILES['img2']['tmp_name'];
    $temp_name3 = $_FILES['img3']['tmp_name'];

    move_uploaded_file($temp_name1, "./image/$product_img1");
    move_uploaded_file($temp_name2, "./image/$product_img2");
    move_uploaded_file($temp_name3, "./image/$product_img3");

    $sql="INSERT INTO products VALUES (DEFAULT,'$pname','$price','$Des','$cat','$qty','$product_img1','$product_img2','$product_img3')";
    $result = mysqli_query($conn, $sql);

    if ($result){
        echo '<script type="text/JavaScript"> 
                alert("Product inserted successfully!");
                </script>';
        echo "<script>window.open('viewprod.php','_self')</script>";
    }
    else
        die("Cannot insert: " . mysqli_error($con));
    mysqli_close($conn);
}
?>
    </div>
</div>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Your E-commerce Store. All rights reserved.</p>
    </footer>
</body>
</html>

