<?php
session_start();
    include("db.php");
    if (!isset($_SESSION['auser']) || empty($_SESSION['auser'])) {
        echo "<script>window.open('login.php', '_self')</script>";
    exit;
}
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $res = mysqli_query($conn, $sql);
    while ($product = mysqli_fetch_array($res)){
?>
<html>
<head>
    <title>Edit Products</title>
    <link rel="stylesheet"  href="style_adm.css">
    <link rel="stylesheet"  href="style_adm2.css">
</head>
<body>
    <header>
        <h1>Welcome to the Admin Panel</h1>
        <nav>
            <ul>
                <li><a href="admin_index.php">Dashboard</a></li>
                <li><a href="viewallcust.php">View Customers</a></li>
                <li><a href="viewprod.php">View Products</a></li>
                <li><a href="addprod.php">Add Products</a></li>
                <li><a href="orders.php">Manage Orders</a></li>
                <?php
                    if(isset($_SESSION['auser']) && !empty($_SESSION['auser'])){
                        echo '<li><a href="admlogout.php">logout</a></li>';
                    }
                    else{
                        echo '<li><a href="login.php">Login/SignUp</a></li>';
                    }
                ?>
                <!-- Add more navigation links as needed -->
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard">
<div class="container">
    <div class="login-container">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                Product Name: <input type="text" name="Pname" value="<?php echo $product['name']; ?>">
            </div>
            <div class="form-group">
                Price: <input type="int" name="price" value="<?php echo $product['price']; ?>">
            </div>
            <div class="form-group">
                Description: <input type="text" name="Des" value="<?php echo $product['description']; ?>">
            </div>
            <div class="form-group">
                Category: <select name="cat">
                <?php 
                  $sql = "SELECT cat_name FROM categories";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_array($result)){
                ?>
                <option value="<?php echo $row['cat_name'];?>" <?php if($row['cat_name']==$product['cat_name']){?>selected<?php }?>><?php echo $row['cat_name']; }?>
                </option>
                </select>
            </div>
            <div class="form-group">
                Quantity: <input type="number" name="qty" value="<?php echo $product['qty']; ?>" min="0">
            </div>
            <div class="form-group">
                Image1: <input type="file" name="img1" accept="image/*" >
            </div>
            <div class="form-group">
                Image2: <input type="file" name="img2" accept="image/*" >
            </div>
            <div class="form-group">
                Image3: <input type="file" name="img3" accept="image/*" >
            </div>
            <br>
            <button type="submit" name="upload">Update Product</button>
        </form>
<?php
$msg = "";

if (isset($_POST['upload'])) {
    $pname = $_POST['Pname'];
    $price = $_POST['price'];
    $Des = $_POST['Des'];
    $qty = $_POST['qty'];
    $cat=$_REQUEST['cat'];
    if(isset($_FILES['img1']) && $_FILES['img1']['error'] == 0) {
        $product_img1 = $_FILES['img1']['name'];
        $temp_name1 = $_FILES['img1']['tmp_name'];
        move_uploaded_file($temp_name1, "./image/$product_img1");
    }
    else
        $product_img1=$product['image1'];
    if(isset($_FILES['img2']) && $_FILES['img2']['error'] == 0) {
        $product_img2 = $_FILES['img2']['name'];
        $temp_name2 = $_FILES['img2']['tmp_name'];
        move_uploaded_file($temp_name2, "./image/$product_img2");
    }
    else
        $product_img2=$product['image2'];
    if(isset($_FILES['img3']) && $_FILES['img3']['error'] == 0) {
        $product_img3 = $_FILES['img3']['name'];
        $temp_name3 = $_FILES['img3']['tmp_name'];
        move_uploaded_file($temp_name3, "./image/$product_img3");
    }
    else
        $product_img3=$product['image3'];
    echo $product['image3'];

    $sql = "UPDATE products SET name = '$pname', price = '$price', description = '$Des', cat_name = '$cat', qty = '$qty', image1 = '$product_img1', image2 = '$product_img2', image3 = '$product_img3' WHERE id = '$product_id'";
    $result = mysqli_query($conn, $sql);

    if ($result){
        echo '<script type="text/JavaScript"> 
                alert("Product updated successfully!");
                </script>';
    echo "<script>window.open('viewprod.php','_self')</script>";
    }
    else
        die("Cannot insert: " . mysqli_error($con));
    mysqli_close($conn);
} 
}
?>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Your E-commerce Store. All rights reserved.</p>
    </footer>
</body>
</html>
