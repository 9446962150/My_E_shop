<?php
session_start();
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    echo "<script>window.open('login.php','_self')</script>";
}

// Include database connection
include("db.php");
$pid = $_GET['product_id'];
$User=($_SESSION['user']);
$query = "SELECT Cid FROM customer WHERE Username='$User'";
$result = mysqli_query($conn, $query);
if (!$result) 
    die("Database error: " . mysqli_error($conn));
$row = mysqli_fetch_array($result);
$cid=$row['Cid'];
$sql="INSERT INTO cart VALUES('$cid','$pid','0')";
$result = mysqli_query($conn, $sql);
echo "<script>window.open('cart.php','_self')</script>";
?>