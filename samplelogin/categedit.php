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
    <title>Edit Category</title>
    <link rel="stylesheet" href="style_adm.css">
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
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard">
            <div class="container">
                <div class="login-container">
                    <form method="POST">
                        <div class="form-group">
                            Enter New Name : <input type="text" name="new_category" placeholder="Category Name" required>
                        </div>
                        <button type="submit" name="sub">Edit Category</button>
                    </form>
<?php
    if (isset($_POST['sub'])) {
    $new_category = $_POST['new_category'];
    $id = $_GET['id'];

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
        $query = "UPDATE categories SET cat_name = '$new_category' WHERE cat_id = '$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo '<script type="text/JavaScript"> 
                alert("Category Edited successfully!");
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
