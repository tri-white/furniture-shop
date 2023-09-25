<?php
session_start();
include("classes/connect.php");
include("classes/cart.php");
    if(isset($_SESSION['mystore_userid']) && isset($_GET['product']) && isset($_GET['quantity']))
    {
        $cart = new Cart();
        $userid = $_SESSION['mystore_userid'];
        $productid = $_GET['product'];
        $quantity = $_GET['quantity'];
        if($quantity<=0){
            header("Location:cart.php");
            die;
        }
        $res = $cart->update_cart($userid, $productid, $quantity);
        header("Location:cart.php");
        die;
    }
    else{
        header("Location:login.php");
        die;
    }
?>