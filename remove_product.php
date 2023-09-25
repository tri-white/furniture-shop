<?php
session_start();
include("classes/connect.php");
include("classes/product.php");
if(isset($_SESSION['mystore_userid']) && isset($_GET['product'])){
    $productid = $_GET['product'];
    $product = new Product();
    $res = $product->remove_product($productid);
}
else{
    header("Location: login.php");
    die;
}
header("Location:shop.php");
die;
?>