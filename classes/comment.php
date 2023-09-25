<?php
class Comment {
    private $error = "";
    public function get_data($commid){
        $DB=new Database();
        $query = "SELECT * FROM comments WHERE id='$commid' limit 1";
        $res = $DB->read($query);
        if(!$res){
            return false;
        }
        return $res[0];
    }
    public function remove_comment($commid){
        $query = "DELETE FROM comments where id = '$commid'";
        
        $DB = new Database();
        $res = $DB->write($query);
    }
    public function create_comment($userid, $data){
        if(empty($data['description'])){
            $this->error .= "Не вдалося додати пустий відгук!<br>";
            return $this->error;
        }
        $text= addslashes($data['description']);

        $productid = $data['product_id'];
        $query = 
        "insert into comments
        (user_id, product_id, text) 
        values ('$userid', '$productid','$text'); ";
        
        $DB = new Database();
        $res = $DB->write($query);

        if($res){
        }
        else{
            $this->error .= "Не вдалося додати комментар. <br>";
            return  $this->error;
        }
    
    }

    public function create_commid(){
        $length=7;
        $id = "";
        for($i=0;$i<$length;$i++){
            $id .= rand(0,9);
        }
        return $id;
    }
    public function check_commid($commid){
        $check = "select * from comments where id = '$commid'";
        $DB = new Database();
        $res = $DB->read($check);
        if(!is_bool($res)){
            return false;
        }
        return true;
    }

    public function get_comments($prodid){

        $query = "select * from comments where product_id='$prodid'";

    $DB = new Database();
    $res = $DB->read($query);
    if(!$res){
        return false;
    }
    return $res;
}
public function get_user_comments($userid){
    $query = "select * from comments where user_id='$userid'";

    $DB = new Database();
    $res = $DB->read($query);
    if(!$res){
        return false;
    }
    return $res;
}
}