<?php
session_start();
if (!isset($_SESSION['auser']) || empty($_SESSION['auser'])) {
    echo "<script>window.open('login.php','_self')</script>";
}

include("db.php");
?>

<html>
<head>
    <title>E-commerce Admin Panel</title>
    <link rel="stylesheet" href="style_adm.css">
    <link rel="stylesheet"  href="style_adm2.css">
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
            <center><h2>Category Details</h2></center></br>
            <table border="5" align="center">
                <tr>
                    <th>Category ID</th>
                    <th>Category Name </th>
                    <th> </th>
                    <th> </th>
                </tr>
                <?php
                $sql = "SELECT * FROM categories";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['cat_id'] . "</td>";
                    echo "<td>" . $row['cat_name'] . "</td>";
                    echo "<td><a href='categedit.php?id=" . $row['cat_id'] . "'>Edit</a></td>";
                    echo "<td><a href='categdelete.php?id=".$row['cat_id']."'>Delete</a></td>";
                    echo "</tr>";
                }
                mysqli_close($conn);
                ?>
            </table>
		<center><a href="addcategory.php"><button type='submit' name='add'>+</button></a></center>
        <center><p >*If you delete a category, it leads to the deletion of all products associated with that category.</p></center>
        </section>
    </main>

    <footer id="footer">
        <p>&copy; 2023 Your E-commerce Store. All rights reserved.</p>
    </footer>
</body>
</html>