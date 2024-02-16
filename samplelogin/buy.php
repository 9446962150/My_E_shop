<?php
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    echo "<script>window.open('login.php','_self')</script>";
    exit();
}

include("db.php");
$user = $_SESSION['user'];
$id = $_GET['product_id'];


?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="stylesbard.css">
    <link rel="stylesheet"  href="style_adm2.css">
  <script src="checkform.js"></script>
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
        <section class="checkout">
            <h2>Checkout</h2>
            <form method="post" name="checkoutForm" onsubmit="return validateForm()">
                <div class="form-group">
                    Name: <input type="text" name="name" placeholder="Fullname" required>
                </div>
                <div class="form-group">
                    Country:<input type="text" name="Country" placeholder="Country" required>
                </div>
                <div class="form-group">
                    City:<input type="text" name="City" placeholder="City" required>
                </div>
                <div class="form-group">
                    Contact:<input type="text" name="Contact" placeholder="contact number" required>
                </div>
                <div class="form-group">
                    Address:<input type="text" name="Address" placeholder="Address" required>
                </div>
                <?php 
                $sql = "SELECT * FROM products WHERE id = '$id'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)){
                ?>
                <div class="form-group">
                    Quantity: <input type="number" name="qty" placeholder="Number of items " min="1" max="<?php echo $row['qty']; }?>" required>
                </div>
                <div class="form-group">
                    Payment mode : 
                    <select name="pmod">
                        <option value="cod">Cash on delivery </option>
                        <option value="upi">UPI</option>
                    </select>
                </div>
                <button type="submit" name="submit">Order now</button>
            </form>
            <?php
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $country = $_POST['Country'];
    $city = $_POST['City'];
    $contact = $_POST['Contact'];
    $address = $_POST['Address'];
    $pmod = $_POST['pmod'];
    $qty = $_POST['qty'];    // Perform validation and sanitization on user input

    $sql = "SELECT * FROM customer WHERE Username = '$user'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) 
    $cid = $row['Cid'];
    $sql = "INSERT INTO payment (invoice_no, Cid, pay_mode) VALUES (DEFAULT,'$cid','$pmod')";
    $resu = mysqli_query($conn, $sql);
    $sql = "SELECT invoice_no FROM payment WHERE Cid='$cid' AND status='Not Paid'";
        $ans = mysqli_query($conn, $sql);
        while ($ret = mysqli_fetch_array($ans))
        $invno=$ret['invoice_no'];

        $sql = "SELECT * FROM products WHERE id = '$id'";
        $res = mysqli_query($conn, $sql);

        while ($r = mysqli_fetch_array($res)) {
            $price = $r['price'];
            $pqty = $r['qty'];
            $amt = $qty * $price;
            $ord_date = date("Y-m-d");


            $sql = "INSERT INTO orders (ord_id, Cid, id, qty, Amount, Name, Country, City, Contact, Address, ord_date, invoice_no, ord_status) VALUES (DEFAULT, '$cid', '$id', '$qty', '$amt', '$name', '$country', '$city', '$contact', '$address', '$ord_date', '$invno', 'Payment Pending')";
            $in = mysqli_query($conn, $sql);

            if (!$in) {
                echo '<script type="text/JavaScript"> alert("Cannot Place order ");</script>';
                echo "<script>window.open('cart.php', '_self')</script>";
            }
        }
        // Code for Cash on Delivery payment processing
        
        $sql = "UPDATE payment SET Amount='$amt' WHERE invoice_no='$invno'";
        $next = mysqli_query($conn, $sql);
        if (!$next) {
            echo '<script type="text/JavaScript"> 
                        alert("Unsuccessful attempt!");
                    </script>';
        $sql = "UPDATE payment SET status='Failed' WHERE invoice_no='$invno'";
        $result = mysqli_query($conn, $sql);
                die();
        } 
        else {
            if($pmod == "cod"){
                    $new_date = date('Y-m-d', strtotime($ord_date . " +4 days"));

                    $sql = "UPDATE products SET qty = qty - $qty WHERE id = '$id'";
                    $res = mysqli_query($conn, $sql);

                    $sql = "UPDATE orders SET deliver_date = '$new_date', ord_status = 'Ordered Successfully' WHERE id = '$id' AND Cid = '$cid' AND invoice_no='$invno'";
                    $res = mysqli_query($conn, $sql);

                echo '<script type="text/JavaScript"> 
                            alert("Ordered Successfully");
                        </script>';
                echo "<script>window.open('myorder.php','_self')</script>";
                }
            }

    if ($pmod == "upi") {
        ?>
            <form method="post" action="payupi.php?no=<?php echo $invno; ?>">
            <div class="form-group">
                Enter UPI id: <input type="text" name="upid" placeholder="UPI id" required>
            </div><br>
                <button type="submit" name="cont"><?php echo "Pay Rs. ".$amt; ?></button>
            </form>
            <?php
    } 
}
?>
        </section>
    </main>

    <footer id="footer">
        <p>&copy; <?php echo date("Y"); ?> Your eCommerce Store. All rights reserved.</p>
    </footer>
</body>
</html>
