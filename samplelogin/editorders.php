<?php
session_start();

if (!isset($_SESSION['auser']) || empty($_SESSION['auser'])) {
    echo "<script>window.open('login.php','_self')</script>";
    exit();
}

    include("db.php");

    $invno = $_GET['no'];
?>
<html>
<head>
    <title>E-commerce Admin Panel</title>
    <link rel="stylesheet" href="style_adm.css">
    <link rel="stylesheet"  href="style_adm2.css">
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
        <div class="container">
	    <div class="login-container">
	        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                Order Status :<select name="stat">
					<option value="Payment Pending">Payment Pending</option>
					<option value="Ordered Successfully">Ordered Successfully</option>
					<option value="Delivered Successfully">Delivered Successfully</option>
                </select>
            </div>
            <div class="form-group">
                Order Status :<select name="pstat">
					<option value="Paid">Paid</option>
					<option value="Not Paid">Not Paid</option>
                </select>
            </div><br>
            <button type="submit" name="ok">Update</button>
        </form>
        <?php
		if (isset($_POST['ok'])) {
			$stat=$_POST['stat'];
			$pstat=$_POST['pstat'];
            $ndate = date("Y-m-d");
            $new_date = date('Y-m-d', strtotime($ndate . " +4 days"));
			if($stat=="Delivered Successfully"){
				$sql = "UPDATE orders SET deliver_date = '$ndate', ord_status = '$stat' WHERE invoice_no='$invno'";
                $res = mysqli_query($conn, $sql);
			}
			elseif ($stat=="Ordered Successfully") {
				$sql = "UPDATE orders SET deliver_date = '$new_date', ord_status = '$stat' WHERE invoice_no='$invno'";
                $res = mysqli_query($conn, $sql);
			}
			elseif ($stat=="Payment Pending") {
				$sql = "UPDATE orders SET ord_status = '$stat' WHERE invoice_no='$invno'";
                $res = mysqli_query($conn, $sql);
			}
			if($pstat=="Paid"){
				$sql = "UPDATE payment SET pay_date='$ndate', status='$pstat' WHERE invoice_no='$invno'";
            	$result = mysqli_query($conn, $sql);
			}
			elseif ($pstat=="Not Paid") {
				$sql = "UPDATE payment SET pay_date='$new_date', status='$pstat' WHERE invoice_no='$invno'";
            	$result = mysqli_query($conn, $sql);
			}
			echo "<script>window.open('orders.php','_self')</script>";
		}
		?>
        </section>
    </main>

    <footer id="footer">
        <p>&copy; 2023 Your E-commerce Store. All rights reserved.</p>
    </footer>
</body>
</html>