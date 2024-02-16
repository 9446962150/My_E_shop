<?php
    session_start();

    if (!isset($_SESSION['auser']) || empty($_SESSION['auser'])) {
        // Redirect to the login page if the user is not logged in
        header("Location: login.php");
        exit;
    }

    include("db.php");

    // Get the customer ID from the URL
    $id = $_GET['cust_id'];

    // Prepare and execute a DELETE query to remove the customer from the database
    $delete_query = "DELETE FROM login WHERE Username = (SELECT Username FROM customer WHERE Cid = '$id')";
    $result = mysqli_query($conn, $delete_query);
    $delete_query = "DELETE FROM customer WHERE Cid = '$id'";
    $result = mysqli_query($conn, $delete_query);

    if ($result){
        echo '<script type="text/JavaScript"> 
                alert("Customer deleted successfully!");
                </script>';
        echo "<script>window.open('viewallcust.php','_self')</script>";
    }
    else {
        // An error occurred while deleting the product
        echo "Error: " . mysqli_error($conn);
    }

mysqli_close($conn);
?>
