<?php
session_start();
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    echo "<script>window.open('login.php','_self')</script>";
}

?>

<html>
<head>
    <title>Cart</title>
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

</style>
</head>
<body>
    <header>
        <h1>Welcome to Your eCommerce Store</h1><br>
        <nav>
            <ul>
                <li><a href="c_index.php">Home</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="myorder.php">My orders</a></li>
                <?php
                    echo '<li><a href="Profile.php">My Profile</a></li>';
                    echo '<li><a href="logout.php">Logout</a></li>';
                ?>
            </ul>
        </nav>
    </header>
    
    <main>
        <section class="featured-products">
            <center><h2>Your Cart Details </h2></center>
            <table border="5" align="center">
                <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Image 1</th>
                    <th>Image 2</th>
                    <th>Image 3</th>
                    <th>Quantity</th>
                    <th>Total</th>
		    <th> </th>
                </tr>
                <?php
                include("db.php");
                $user = $_SESSION['user'];
                $total=0;
                $temp=0;
                $sql = "SELECT * FROM products WHERE id IN (SELECT id FROM cart WHERE Cid=(SELECT Cid FROM customer WHERE Username='$user'))";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result)<1)
                    die("<center><h2>! No Products in Cart !</h2></center>");
                while ($row = mysqli_fetch_array($result)) {
                    $id=$row['id'];
                    $sql = "SELECT * FROM cart WHERE Cid=(SELECT Cid FROM customer WHERE Username='$user') AND id='$id'";
                    $qres = mysqli_query($conn, $sql);
                    while ($num = mysqli_fetch_array($qres)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>Rs. " . $row['price'] . "</td>";
                    echo "<td><img src='./image/".$row["image1"]."' width='30' height='30'></td>";
                    echo "<td><img src='./image/".$row["image2"]."' width='30' height='30'></td>";
                    echo "<td><img src='./image/".$row["image3"]."' width='30' height='30'></td>";
                    echo "<form method='post' action='addqty.php?id=" . $row['id'] . "''>";
                    echo "<td><input type='number' name='qty' value='".$num["qty"]."' min='0' max='" . $row["qty"] . "'/>";
		            echo "<button type='submit' name='ok'>ok</button></td></form>";
		    		
                    echo "<td>Rs. " . ($row['price'] * $num["qty"]) . "</td>";
		            echo "<td><a href='cartremove.php?product_id=" . $row['id'] . "'><button type='submit'>Remove</button></a></td>";
                    $total=$total+($row['price'] * $num["qty"]);
                    if($num["qty"]<1)
                    	$temp=1;
                    
		    	}
                echo "</tr>";
                }
                echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td>Grand Total</td><td>Rs. ".$total."</td>";
                if($temp==0)
					echo "<td><a href='checkout.php'><button type='submit' name='check'>Checkout</button></a></td></tr></table>";
				else 
					echo "<td>Cannot checkout!</td></tr></table>";

                ?>
	    
        </section>
    </main>
    
    <footer id="footer">
        <p>&copy; <?php echo date("Y"); ?> Your eCommerce Store. All rights reserved.</p>
    </footer>
</body>
</html>
