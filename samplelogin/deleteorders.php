<?php
session_start();

if (!isset($_SESSION['auser']) || empty($_SESSION['auser'])) {
    echo "<script>window.open('login.php','_self')</script>";
    exit();
}

    include("db.php");

    $invno = $_GET['no'];
    $sql = "SELECT * FROM orders WHERE invoice_no='$invno'";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_array($result)){ 
		$qty = $row['qty'];
		$id = $row['id'];
		$sql = "UPDATE products SET qty = qty + $qty WHERE id = '$id'";
		$res = mysqli_query($conn, $sql);
	}
    $sql = "DELETE FROM payment WHERE invoice_no='$invno'";
    $result = mysqli_query($conn, $sql);
	echo "<script>window.open('orders.php','_self')</script>";

?>