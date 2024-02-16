<?php
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    // Redirect to login if the user is not logged in
    header("Location: login.php");
    exit();
}


    // Get the product ID from the URL parameter
    $product_id = $_GET['product_id'];

    // Include your database connection file
    include("db.php");

    // Get the user from the session
    $user = $_SESSION['user'];

    // Delete the item from the cart
    $sql = "DELETE FROM cart WHERE Cid=(SELECT Cid FROM customer WHERE Username='$user') AND id='$product_id'";
    $result = mysqli_query($conn, $sql);

    // Check if the deletion was successful
    if ($result) {
        echo '<script type="text/JavaScript"> 
                alert("Product removed from cart successfully!");
                </script>';
        header("Location: cart.php");
    } 
    else {
        // Handle the error, maybe redirect to an error page
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
?>
