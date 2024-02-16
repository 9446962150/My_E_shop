<?php
session_start();
    include("db.php");
if (!isset($_SESSION['auser']) || empty($_SESSION['auser'])) {
    echo "<script>window.open('login.php', '_self')</script>";
    exit;
}
?>

<html>
<head>
    <title>Add Admin </title>
    <link rel="stylesheet"  href="style_adm.css">
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
        <h1>Welcome to the Admin Panel</h1></br>
        <nav>
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
            <center><h2>Create Admin </h2></center></br>
        <div class="container">
            <div class="login-container">
            <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
              Username: <input type="text" name="User" placeholder="Username" required>
            </div>
            <div class="form-group">
              Password:<input type="password" name="Pass" placeholder="Password" minlength="8" required>
            </div><br>
                <button type="submit" name="ok">Create</button>
        </form>
<?php
if(isset($_REQUEST["ok"]))
{
    $user=$_REQUEST['User'];
    $pass=$_REQUEST['Pass'];
    $sql="INSERT INTO login VALUES('$user','$pass','Admin')";
    $result=mysqli_query($conn,$sql);
    if(!$result)
      die("Cannot create account");
    if($result)
    echo '<script type="text/JavaScript"> 
                alert("Account Created");
                </script>';
    mysqli_close($conn);
}
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

