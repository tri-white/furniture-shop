<?php
session_start();
include("classes/connect.php");
include("classes/comment.php");
include("classes/order.php");
if(isset($_SESSION['mystore_userid']) && isset($_GET['orderid']) && isset($_GET['userid'])){
    $orderid = $_GET['orderid'];
    $order = new Order();
    $res = $order->remove_order($orderid);
    $id = $_GET['userid'];
    $query = "Location: profile.php?id=" . $id;
    header($query);
    die;    
}
else{
    header("Location: login.php");
    die;
}

?>