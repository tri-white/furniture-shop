<?php
session_start();
include("classes/connect.php");
include("classes/comment.php");
include("classes/order.php");
if(isset($_SESSION['mystore_userid']) && isset($_GET['orderid'])){
    $orderid = $_GET['orderid'];
    $order = new Order();
    $res = $order->remove_order($orderid);
    $query = "Location: all-orders.php";
    header($query);
    die;    
}
else{
    header("Location: login.php");
    die;
}

?>