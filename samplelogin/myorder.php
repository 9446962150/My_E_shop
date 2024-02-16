<?php
session_start();
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    echo "<script>window.open('login.php','_self')</script>";
}

?>

<html>
<head>
    <title>Orders</title>
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
                <li><a href="Profile.php">My Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section class="featured-products">
            <center><h2>Your Orders</h2></center>
            <table border="5" align="center">
                <tr>
                    <th>Order Id</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Recipient name</th>
                    <th>Recipient address</th>
                    <th>Order date </th>
                    <th>Delivery date </th>
                    <th>Order status</th>
                    <th>Mode of Pay</th>
                    <th>Invoice</th>
                </tr>
                <?php
                include("db.php");
                $user = $_SESSION['user'];
                $sql = "SELECT * FROM orders WHERE Cid = (SELECT Cid FROM customer WHERE Username = '$user')";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    $cid = $row['Cid'];
                    echo "<td>" . $row['ord_id'] . "</td>";
                    $id = $row['id'];
                    $query = "SELECT * FROM products WHERE id = '$id'";
                    $product_result = mysqli_query($conn, $query);
                    $product = mysqli_fetch_array($product_result);
                    echo "<td>" . $product['name'] . "</td>";
                    echo "<td><img src='./image/".$product["image1"]."' width='30' height='30'></td>";
                    echo "<td>" . $row['qty'] . "</td>";
                    echo "<td>" . $row['Amount'] . "</td>";
                    echo "<td>" . $row['Name'] . "</td>";
                    echo "<td>" . $row['Address'] . "</td>";
                    echo "<td>" . $row['ord_date'] . "</td>";
                    $invno=$row['invoice_no'];
                    echo "<td>" . $row['deliver_date'] . "</td>";
                    echo "<td>" . $row['ord_status'] . "</td>";
                    $sql = "SELECT * FROM payment WHERE Cid='$cid' AND invoice_no='$invno'";
                    $ans = mysqli_query($conn, $sql);
                    $ret = mysqli_fetch_array($ans);
                    echo "<td>" . $ret['pay_mode']. "</td>";
                    if ($ret['status']=="Paid")
                        echo "<td><a href='invoicemaker.php?no=" . $invno . "'>Download</a></td>";
                    else
                        echo "<td> </td>";
                    echo "</tr>";
                }
                mysqli_close($conn);
                ?>
            </table>
        </section>
    </main>
    
    <footer id="footer">
        <p>&copy; <?php echo date("Y"); ?> Your eCommerce Store. All rights reserved.</p>
    </footer>
</body>
</html>
