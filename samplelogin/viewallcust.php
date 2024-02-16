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
                <!-- Add more navigation links as needed -->
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard">
            <center><h2>Details</h2></center>
            <table border="5" align="center">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th> </th>
                    <th> </th>
                </tr>
                <?php
                $sql = "SELECT * FROM customer ORDER BY Cid";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['Cid'] . "</td>";
                    echo "<td>" . $row['Fullname'] . "</td>";
                    echo "<td>" . $row['Username'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "<td>" . $row['Country'] . "</td>";
                    echo "<td>" . $row['City'] . "</td>";
                    echo "<td>" . $row['Contact'] . "</td>";
                    echo "<td>" . $row['Address'] . "</td>";
                    echo "<td><a href='custedit.php?cust_id=" . $row['Cid'] . "'>Edit</a></td>";
                    echo "<td><a href='custdelete.php?cust_id=".$row['Cid']."'>Delete</a></td>";
                    echo "</tr>";
                }
                mysqli_close($conn);
                ?>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Your E-commerce Store. All rights reserved.</p>
    </footer>
</body>
</html>
