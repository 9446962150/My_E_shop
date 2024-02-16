<?php
session_start();

if (!isset($_SESSION['auser']) || empty($_SESSION['auser'])) {
    echo "<script>window.open('login.php', '_self')</script>";
    exit;
}

include("db.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="style_adm.css">
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
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard">
            <div class="container">
                <div class="login-container">
                    <form method="POST">
                        <div class="form-group">
                            New Category: <input type="text" name="new_category" placeholder="Category Name" required>
                        </div>
                        <button type="submit" name="add_category">Add Category</button>
                    </form>
<?php
    if (isset($_POST['add_category'])) {
    $new_category = $_POST['new_category'];

    // Check if the category already exists
    $check_query = "SELECT * FROM categories WHERE cat_name = '$new_category'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo '<script type="text/JavaScript"> 
                alert("Category already exists. Please choose a different name.");
                </script>';
    } 
    else 
    {
        // Insert the new category into the database
        $insert_query = "INSERT INTO categories VALUES (DEFAULT,'$new_category')";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            echo '<script type="text/JavaScript"> 
                alert("Category added successfully!");
            </script>';
            echo "<script>window.open('viewcategory.php','_self')</script>";
        } 
        else {
            echo "Error adding the category: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Your E-commerce Store. All rights reserved.</p>
    </footer>
</body>
</html>
