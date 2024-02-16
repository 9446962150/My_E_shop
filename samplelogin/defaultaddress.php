<?php
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    echo "<script>window.open('login.php','_self')</script>";
    exit();
}

include("db.php");
$user = $_SESSION['user'];
$sql = "SELECT * FROM customer WHERE Username='$user'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    $name = $row['Fullname'];
    $country = $row['Country'];
    $city = $row['City'];
    $contact = $row['Contact'];
    $address = $row['Address'];
}
?>