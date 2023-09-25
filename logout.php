<?php 
session_start();
unset($_SESSION['mystore_userid']); 
header("Location: login.php");
die;
?>
