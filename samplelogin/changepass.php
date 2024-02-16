<?php
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    echo "<script>window.open('login.php','_self')</script>";
    exit;
}

include("db.php");
$user = $_SESSION['user'];
$sql = "SELECT * FROM customer WHERE Username='$user'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    $pass = $row['Password'];
}

?>

<html>
<head>
    <title>Edit Password</title>
    <link rel="stylesheet" type="text/css" href="stylesbard.css">
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
        <section class="edit-profile">
            <h2>Edit Password</h2>
            <form method="post">
            <div class="form-group">
                Enter old Password : <input type="Password" name="pass1" placeholder='Enter old Password' required>
            </div>
            <div class="form-group">
                Confirm old Password :<input type="Password" name="pass2" placeholder='Confirm old Password' required>
            </div><br>
                <button type="submit" name="submit" minlength="8" >Set New Password</button>
            </form>
            <?php
            if(isset($_REQUEST["submit"]))
            {
                $pass1 = $_REQUEST['pass1'];
                $pass2 = $_REQUEST['pass2'];
                if($pass1==$pass2 && $pass1==$pass){
                    echo "<script>window.open('newpassword.php','_self')</script>";
                }
                else
                echo '<script type="text/JavaScript"> 
                    alert("Incorrect Password");
                    </script>';
            }
            ?>
        </section>
    </main>

    <footer id="footer">
        <p>&copy; <?php echo date("Y"); ?> Your eCommerce Store. All rights reserved.</p>
    </footer>
</body>
</html>
