<?php
    session_start();
    include("db.php");
    $user = $_SESSION['user'];
    $qty=$_REQUEST['qty'];
    $id=$_GET['id'];
    $sql="UPDATE cart SET qty='$qty' WHERE Cid=(SELECT Cid FROM customer WHERE Username='$user') AND id='$id'";
    $res = mysqli_query($conn, $sql);
    echo "<script>window.open('cart.php','_self')</script>";
?>