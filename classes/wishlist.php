<?php
class Wishlist {
    public function change_wish($userid, $prodid){
        $res = $this->check_wish($userid, $prodid);
        if($res == false){
            $query = "insert into wishlist (user_id, product_id) values ('$userid','$prodid')";
            $db = new Database();
            $res = $db->write($query);
            return $res;
        }
        else{
            $query = "delete from wishlist where user_id='$userid' and product_id='$prodid'";
            $db = new Database();
            $res = $db->write($query);
            return $res;
        }
    }
    public function check_wish($userid,$prodid){
        $query = "select * from wishlist where user_id='$userid' and product_id='$prodid'";
        $db = new Database();
        $res = $db->read($query);
        if(is_bool($res)){
            return false;
        }
        return true;
    }
    public function get_wishes($userid){
        $query = "select * from wishlist where user_id='$userid'";
        $db = new Database();
        $res = $db->read($query);
        if(is_bool($res)){
            return false;
        }
        return $res;
    }
}