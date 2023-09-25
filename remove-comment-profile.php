<?php
    session_start();
    include("classes/connect.php");
    include("classes/comment.php");
    if(isset($_SESSION['mystore_userid']) && isset($_GET['commid'])){
        $commid = $_GET['commid'];
        $comment = new Comment();
        $data = $comment->get_data($commid);
        $id = $_SESSION['mystore_userid'];
        $res = $comment->remove_comment($commid);
        $query = "Location: profile.php?id=" . $id;
        header($query);
        die;    
    }
    else{
        header("Location: login.php");
        die;
    }

?>