<?php
    session_start();

    if (!isset($_SESSION['auser']) || empty($_SESSION['auser'])) {
        // Redirect to the login page if the user is not logged in
        header("Location: login.php");
        exit;
    }

    include("db.php");

    // Get the product ID from the URL
    $product_id = $_GET['product_id'];

    // Prepare and execute a DELETE query to remove the product from the database
    $delete_query = "DELETE FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $delete_query);

    if ($result){
        echo '<script type="text/JavaScript"> 
                alert("Product deleted successfully!");
                </script>';
        echo "<script>window.open('viewprod.php','_self')</script>";
    }
    else {
        // An error occurred while deleting the product
        echo "Error: " . mysqli_error($conn);
    }

mysqli_close($conn);
?>
