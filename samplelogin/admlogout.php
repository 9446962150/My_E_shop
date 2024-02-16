<?php
session_start();

unset($_SESSION['auser']);

echo '<script>alert("Logout completed")</script>';
echo '<script>window.open("login.php","_self")</script>';

?>
