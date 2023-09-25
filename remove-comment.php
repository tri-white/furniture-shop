<?php
session_start();
include("classes/connect.php");
include("classes/comment.php");
if(isset($_SESSION['mystore_userid']) && isset($_GET['commid'])){
    $commid = $_GET['commid'];
    $comment = new Comment();
    $data = $comment->get_data($commid);
    $id = $data['product-id'];
    $res = $comment->remove_comment($commid);
    $query = "Location: product-page.php?id=" . $id;
    header($query);
    die;    
}
else{
    header("Location: login.php");
    die;
}

?>