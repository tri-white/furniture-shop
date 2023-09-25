<?php

class User{
    public function get_data($userid){
        $DB=new Database();
        $query = "SELECT * FROM users WHERE id='$userid' limit 1";
        $res = $DB->read($query);
        if(!$res){
            return false;
        }
        return $res[0];
    }
    public function get_orders($userid){
        $query = "select * from post where userid = $userid order by date DESC";
        $DB = new Database();
        $res = $DB->read($query);
        if(empty($res)){
            return false;
        }
        return $res;
    }
    public function remove_user($userid){
        $query = "delete from wishlist where user_id = '$userid'";
        $DB = new Database();
        $res = $DB->write($query);

        $query = "delete from cart where user_id = '$userid'";
        $DB = new Database();
        $res = $DB->write($query);

        $query = "delete from orders where user_id = '$userid'";
        $DB = new Database();
        $res = $DB->write($query);
        
        $query = "delete from users where id = '$userid'";
        $DB = new Database();
        $res = $DB->write($query);
    }
}