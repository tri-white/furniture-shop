<?php
session_start();
include("classes/connect.php");
include("classes/cart.php");
if(isset($_SESSION['mystore_userid']) && isset($_GET['cartid'])){
    $userid = $_SESSION['mystore_userid'];
    $cartid = $_GET['cartid'];
    $cart = new Cart();
    $res = $cart->remove_cart($cartid);
    header("Location:cart.php");
    die;
}
else{
    header("Location: login.php");
    die;
}

?>