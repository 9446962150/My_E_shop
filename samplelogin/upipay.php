<?php
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    echo "<script>window.open('login.php','_self')</script>";
    exit();
}

    include("db.php");
    $user = $_SESSION['user'];

         $upid = $_POST['upid'];
            $ord_date = date("Y-m-d");
            $invno = $_GET['no'];
            /* Perform UPI payment processing here(SELECT DISTINCT(invoice_no) FROM orders WHERE Cid = (SELECT Cid FROM customer WHERE Username = '$user') AND ord_status = 'Payment Pending')*/

            $sql = "UPDATE payment SET pay_date='$ord_date', status='Paid' WHERE invoice_no='$invno'";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                echo '<script type="text/JavaScript"> 
                        alert("Unsuccessful attempt!");
                    </script>';
                $sql = "UPDATE payment SET status='Failed' WHERE invoice_no='$invno'";
                $result = mysqli_query($conn, $sql);
                die();
            } 
            else {
                echo '<script type="text/JavaScript"> 
                        alert("Paid");
                    </script>';
            }
        $sql = "SELECT * FROM cart WHERE Cid = (SELECT Cid FROM customer WHERE Username = '$user')";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result)) {
            $cid = $row['Cid'];
            $id = $row['id'];
            $qty = $row['qty'];
            $new_date = date('Y-m-d', strtotime($ord_date . " +4 days"));

            $sql = "UPDATE products SET qty = qty - $qty WHERE id = '$id'";
            $res = mysqli_query($conn, $sql);

            $sql = "UPDATE orders SET deliver_date = '$new_date', ord_status = 'Ordered Successfully' WHERE id = '$id' AND Cid = '$cid' AND invoice_no='$invno'";
            $res = mysqli_query($conn, $sql);
        }

        $sql = "DELETE FROM cart WHERE Cid = (SELECT Cid FROM customer WHERE Username = '$user')";
        $result = mysqli_query($conn, $sql);
        echo "<script>window.open('myorder.php','_self')</script>";

?>