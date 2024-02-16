<?php
session_start();

unset($_SESSION['user']);

echo '<script>alert("Logout completed")</script>';
echo '<script>window.open("login.php","_self")</script>';

?>
