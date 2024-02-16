<?php
  session_start();
  if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
      echo "<script>window.open('index.php','_self')</script>";
  }
  ?>
<html>
<head>
  <title>Sign Up</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="formValidation.js"></script>
</head>
<body>
    <div class="container">
    <div class="login-container">
    <form method="post" name="registrationForm" onsubmit="return validateForm()">
    <a href="login.php">Go back</a><center><h1>Sign Up</h1></center><br/>
    <div class="form-group">
      Fullname: <input type="text" name="full" placeholder="Fullname">
    </div>
    <div class="form-group">
      Username: <input type="text" name="User" placeholder="Username">
    </div>
    <div class="form-group">
      Email:<input type="email" name="Email" placeholder="Email">
    </div>
    <div class="form-group">
      Password:<input type="password" name="Pass" placeholder="Password" >
    </div>
    <div class="form-group">
      Country:<input type="text" name="Country" placeholder="Country">
    </div>
    <div class="form-group">
      City:<input type="text" name="City" placeholder="City">
    </div>
    <div class="form-group">
      Contact:<input type="int" name="Contact" placeholder="contact number">
    </div>
    <div class="form-group">
      Address:<input type="text" name="Address" placeholder="Address">
    </div>
    <br>
      <button type="submit" name="sign">Sign Up</button>
  </form>
<?php
if(isset($_REQUEST["sign"]))
{
    include("db.php");
    $full=$_REQUEST['full'];
    $user=$_REQUEST['User'];
    $email=$_REQUEST['Email'];
    $pass=$_REQUEST['Pass'];
    $country=$_REQUEST['Country'];
    $city=$_REQUEST['City'];
    $contact=$_REQUEST['Contact'];
    $address=$_REQUEST['Address'];
    $sql="INSERT INTO customer VALUES (DEFAULT,'$full','$user','$email','$pass','$country','$city','$contact','$address')";
    $result=mysqli_query($conn,$sql);
    if(!$result)
      die("Cannot create account");
    echo '<script type="text/JavaScript"> 
                alert("Account Created.\nLogin to continue");
                </script>';
    //echo "<scripAccount Created ".$user;
    $sql="INSERT INTO login VALUES('$user','$pass','Customer')";
    $result=mysqli_query($conn,$sql);
    if($result)
      echo "<br>You can login now<script>window.open('login.php','_self')</script>";
}
?>
</div>
</div>
</body>
</html>