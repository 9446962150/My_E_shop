<?php
session_start();
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    echo "<script>window.open('login.php','_self')</script>";
}

?>

<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="stylesbard.css">
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
</style></head>
<body>
    <header>
        <h1>Welcome to Your eCommerce Store</h1><br>
        <nav>
            <ul>
                <li><a href="c_index.php">Home</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="myorder.php">My orders</a></li>
                <li><a href="Profile.php">My Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section class="featured-products">
            <center><h2>Your Details</h2></center>
            <table border="5" align="center">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Contact</th>
                    <th>Address</th>
                </tr>
                <?php
                include("db.php");
                $user = $_SESSION['user'];
                $sql = "SELECT * FROM customer WHERE Username='$user'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    $x=$row['Cid'];
                    echo "<td>" . $row['Cid'] . "</td>";
                    echo "<td>" . $row['Fullname'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "<td>" . $row['Country'] . "</td>";
                    echo "<td>" . $row['City'] . "</td>";
                    echo "<td>" . $row['Contact'] . "</td>";
                    echo "<td>" . $row['Address'] . "</td>";
                    echo "</tr>";
                }
                mysqli_close($conn);
                ?>
            </table></br>
            <center><p>Do you want to edit? <a href="editprofile.php">Click</a></p></center></br>
            <center><p>Do you want change password? <a href="changepass.php">Click</a></p></center>
        </section>
    </main>
    
    <footer id="footer">
        <p>&copy; <?php echo date("Y"); ?> Your eCommerce Store. All rights reserved.</p>
    </footer>
</body>
</html>
