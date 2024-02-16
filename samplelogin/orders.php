<?php
    session_start();
    if (!isset($_SESSION['auser']) || empty($_SESSION['auser'])) {
    echo "<script>window.open('login.php', '_self')</script>";
    }
    include("db.php");
?>
<html>
<head>
    <title>E-commerce Admin Panel</title>
    <link rel="stylesheet" href="style_adm.css">
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
        <h1>Welcome to the Admin Panel</h1>
        <nav>
            <ul>
                <li><a href="admin_index.php">Dashboard</a></li>
                <li><a href="viewallcust.php">View Customers</a></li>
                <li><a href="viewprod.php">View Products</a></li>
                <li><a href="orders.php">Manage Orders</a></li>
                <li><a href="admlogout.php">Logout</a></li>
                <!-- Add more navigation links as needed -->
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard">
            <!-- Your dashboard content goes here -->
            <center><h2>Customer Orders</h2></center>
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
                    <th>Invoice Number </th>
                    <th>Delivery date </th>
                    <th>Order status</th>
                    <th>Mode of Pay</th>
                    <th>Edit </th>
                    <th> </th>
                </tr>
                <?php
                $sql = "SELECT * FROM orders";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
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
                    echo "<td>" . $row['invoice_no'] . "</td>";
                    $invno=$row['invoice_no'];
                    echo "<td>" . $row['deliver_date'] . "</td>";
                    echo "<td>" . $row['ord_status'] . "</td>";
                    $sql = "SELECT * FROM payment WHERE invoice_no='$invno'";
                    $ans = mysqli_query($conn, $sql);
                    $ret = mysqli_fetch_array($ans);
                    echo "<td>" . $ret['pay_mode']. "</td>";
                    echo "<td><a href='editorders.php?no=" . $invno . "'>Change</a></td>";
                    echo "<td><a href='deleteorders.php?no=" . $invno . "'>Delete</a></td>";
                    echo "</tr>";
                }
                mysqli_close($conn);
                ?>
            </table>
        </section>
    </main>

    <footer id="footer">
        <p>&copy; 2023 Your E-commerce Store. All rights reserved.</p>
    </footer>
</body>
</html>
