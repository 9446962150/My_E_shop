<?php
session_start();
    include("db.php");
    if (!isset($_SESSION['auser']) || empty($_SESSION['auser'])) {
        echo "<script>window.open('login.php', '_self')</script>";
    exit;
}
    $id = $_GET['cust_id'];
    $sql = "SELECT * FROM customer WHERE Cid = $id";
    $res = mysqli_query($conn, $sql);
    while ($product = mysqli_fetch_array($res)){
?>
<html>
<head>
    <title>Edit Customer</title>
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
                Fullname: <input type="text" name="full" value="<?php echo $product['Fullname']; ?>">
            </div>
            <div class="form-group">
                Email:<input type="email" name="Email" value="<?php echo $product['Email']; ?>">
            </div>
            <div class="form-group">
                Country:<input type="text" name="Country" value="<?php echo $product['Country']; ?>">
            </div>
            <div class="form-group">
                City:<input type="text" name="City" value="<?php echo $product['City']; ?>">
            </div>
            <div class="form-group">
                Contact:<input type="int" name="Contact" value="<?php echo $product['Contact']; ?>">
            </div>
            <div class="form-group">
                Address:<input type="text" name="Address" value="<?php echo $product['Address']; ?>">
            </div>
            <br>
            <button type="submit" name="sign">Update Product</button>
        </form>
<?php
if(isset($_REQUEST["sign"]))
{
    include("db.php");
    $user=$product['Username'];
    $full=$_REQUEST['full'];
    $email=$_REQUEST['Email'];
    $country=$_REQUEST['Country'];
    $city=$_REQUEST['City'];
    $contact=$_REQUEST['Contact'];
    $address=$_REQUEST['Address'];

    $sql = "UPDATE customer SET Fullname = '$full', Email = '$email', Country = '$country', City = '$city', Contact = '$contact', Address = '$address' WHERE Cid = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result){
        echo '<script type="text/JavaScript"> 
                alert("Details updated successfully!");
                </script>';
    echo "<script>window.open('viewallcust.php','_self')</script>";
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
