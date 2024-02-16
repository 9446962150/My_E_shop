<?php
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    echo "<script>window.open('login.php','_self')</script>";
    exit;
}

include("db.php");
$user = $_SESSION['user'];
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
                Enter new Password : <input type="Password" name="pass1" placeholder='Enter new Password' required>
            </div><br>
                <button type="submit" name="submit">Set Password</button>
            </form>
            <?php
            if(isset($_REQUEST["submit"]))
            {
                $pass1 = $_REQUEST['pass1'];
                $sql="UPDATE customer SET Password='$pass1' WHERE Username='$user'";
                $res=mysqli_query($conn,$sql);
                if(!$res){
                echo '<script type="text/JavaScript"> 
                    alert("Cannot Update ");
                    </script>';
                    die();
                }
                echo '<script type="text/JavaScript"> 
                    alert("Updated successfully");
                    </script>';
                $sql="UPDATE login SET Password='$pass1' WHERE Username='$user' AND Role='Customer'";
                $result=mysqli_query($conn,$sql);
                echo "<script>window.open('Profile.php','_self')</script>";
            }
            ?>
        </section>
    </main>

    <footer id="footer">
        <p>&copy; <?php echo date("Y"); ?> Your eCommerce Store. All rights reserved.</p>
    </footer>
</body>
</html>
