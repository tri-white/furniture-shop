<?php
session_start();
include("classes/connect.php");
include("classes/product.php");
if(isset($_SESSION['mystore_userid']) && isset($_GET['id'])){
    $userid = $_GET['id'];
    $user = new User();
    $res = $user->remove_user($user_id);
    header("Location:index.php");
die;
}
else{
    header("Location: login.php");
    die;
}

?>