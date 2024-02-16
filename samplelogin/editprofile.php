<?php
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    echo "<script>window.open('login.php','_self')</script>";
    exit;
}

include("db.php");
$user = $_SESSION['user'];
$sql = "SELECT * FROM customer WHERE Username='$user'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    $fullname = $row['Fullname'];
    $email = $row['Email'];
    $country = $row['Country'];
    $city = $row['City'];
    $contact = $row['Contact'];
    $address = $row['Address'];
}

?>

<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="stylesbard.css">
    <link rel="stylesheet"  href="style_adm2.css">
</head>
<body>
    <header>
        <h1>Welcome to Your eCommerce Store</h1><br>
        <nav>
            <ul>
                <li><a href="c_index.php">Home</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="myorder.php">My orders</a></li>
                <li><a href="Profile.php">My Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="edit-profile">
            <h2>Edit Profile</h2>
            <form method="post">
            <div class="form-group">
                Fullname: <input type="text" name="full" value="<?php echo $fullname; ?>">
            </div>
            <div class="form-group">
                Email:<input type="email" name="Email" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                Country:<input type="text" name="Country" value="<?php echo $country; ?>">
            </div>
            <div class="form-group">
                City:<input type="text" name="City" value="<?php echo $city; ?>">
            </div>
            <div class="form-group">
                Contact:<input type="int" name="Contact" value="<?php echo $contact; ?>">
            </div>
            <div class="form-group">
                Address:<input type="text" name="Address" value="<?php echo $address; ?>">
            </div><br>
                <button type="submit" name="submit">Save Changes</button>
            </form>
            <?php
            if(isset($_REQUEST["submit"]))
            {
                $fullname = $_REQUEST['full'];
                $email = $_REQUEST['Email'];
                $country = $_REQUEST['Country'];
                $city=$_REQUEST['City'];
                $contact=$_REQUEST['Contact'];
                $address=$_REQUEST['Address'];
                $sql="UPDATE customer SET Fullname='$fullname', Email='$email', Country='$country',City='$city',Contact='$contact',Address='$address' WHERE Username='$user'";
                $res=mysqli_query($conn,$sql);
                if(!$res)
                    die("Cannot Update ");
                echo '<script type="text/JavaScript"> 
                    alert("Updated successfully");
                    </script>';
                echo "<script>window.open('Profile.php','_self')</script>";
            }
            ?>
        </section>
    </main>

    <footer id="footer">
        <p>&copy; <?php echo date("Y"); ?> Your eCommerce Store. All rights reserved.</p>
    </footer>
</body>
</html>
