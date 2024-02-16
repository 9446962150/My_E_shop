<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
    <div class="login-container">
    <form method="POST">
        <a href="login.php">Go back<a><center><h1>Forgot Password</h1></center><br>
            <div class="form-group">
                Username: <input type="text" name="user" placeholder="Username" required>
            </div>
            <div class="form-group">
                New Password: <input type="password" name="pass" placeholder="New Password" minlength="8" required>
            </div>
            <button type="submit" name="Up">Update</button><br>
            <center>Not a user?<a href="sam1.php">Create an account</a><br>
    </form>
    <?php
    if(isset($_REQUEST["Up"]))
    {
        $con=mysqli_connect("localhost:3306","root","","Eshop");
        if(!$con)
            die("could not connect".mysqli_connect_error());
        $user=$_REQUEST['user'];
        $pass=$_REQUEST['pass'];
        $role="Customer";
        $sql="SELECT * FROM login WHERE Username='$user' AND Role='$role'";
        $result=mysqli_query($con,$sql);
        if(mysqli_num_rows($result)<1)
            die("Enter correct username".mysqli_connect_error());
        $sql="UPDATE login SET Password='$pass' WHERE Username='$user' AND Role='$role'";
        $result=mysqli_query($con,$sql);
        if(!$result)
            echo "Updated ".$user;
        $sql="UPDATE customer SET Password='$pass' WHERE Username='$user'";
        $result=mysqli_query($con,$sql);
        echo "<br>Login with new Password";
    }
    ?>
    </div>
    </div>
</body>
</html>