<?php
class Cart {
    private $error = "";
    public function get_data($userid){
        $DB=new Database();
        $query = "SELECT * FROM cart WHERE user_id='$userid'";
        $res = $DB->read($query);
        if(!$res){
            return false;
        }
        return $res;
    }
    public function remove_cart($cartid){
        $DB=new Database();
        $query = "DELETE FROM cart WHERE id='$cartid'";
        $res = $DB->write($query);
    }
    public function clear_cart($userid){
        $DB=new Database();
        $query = "DELETE FROM cart WHERE user_id='$userid'";
        $res = $DB->write($query);
    }
    public function add_cart($userid, $prodid, $quantity){
        if($this->check_cart($userid, $prodid) == true){
            $this->error.="Продукт вже в корзині!<br>";
            return $this->error;
        }
        if(!is_numeric($quantity) || $quantity <=0){
            $this->error.="Неправильно вказано кількість!<br>";
            return $this->error;
        }

        $query = 
        "insert into cart
        (user_id, product_id, quantity) 
        values ('$userid', '$prodid', '$quantity');";

        $DB = new Database();
        $res = $DB->write($query);

        if($res){
        }
        else{
            $this->error .= "Не вдалося додати продукт в корзину. <br>";
            return  $this->error;
        }
    
    }
    public function check_cart($userid,$prodid){
        $query = "select * from cart where user_id='$userid' and product_id='$prodid'";
        $db = new Database();
        $res = $db->read($query);
        if(is_bool($res)){
            return false;
        }
        return true;
    }
    public function get_sum($userid){
        $res = $this->get_data($userid);
        $sum = 0;
        if(is_bool($res)){
            return 0;
        }
        foreach($res as $item){
            $product = new Product();
            $item_price = $product->get_data($item['product_id'])['price'];
            $sum = $sum + $item['quantity'] * $item_price;
        }
        return $sum;
    }
    public function update_cart($userid, $productid, $quantity){
        $query = "UPDATE cart SET quantity='$quantity' where user_id='$userid' and product_id='$productid'";
        $db = new Database();
        $res = $db->write($query);
        if($res){
        }
        else{
            $this->error .= "Не вдалося оновити кількість в корзині. <br>";
            return  $this->error;
        }
    }
}