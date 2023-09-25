<?php
class Order {
    private $error = "";
    public function get_data($userid){
        $DB=new Database();
        $query = "SELECT * FROM orders WHERE user_id='$userid'";
        $res = $DB->read($query);
        if(!$res){
            return false;
        }
        return $res;
    }
    public function get_data_order($orderid){
        $DB=new Database();
        $query = "SELECT * FROM orders WHERE id='$orderid'";
        $res = $DB->read($query);
        if(!$res){
            return false;
        }
        return $res[0];
    }
    public function get_items($orderid){
        $DB=new Database();
        $query = "SELECT * FROM order_item WHERE order_id='$orderid'";
        $res = $DB->read($query);
        if(!$res){
            return false;
        }
        return $res;
    }
    public function create_order($userid, $data){
        $cart = new Cart();
        $cart_data = $cart->get_data($userid);
        if(is_bool($cart_data)){
            $this->error.="Немає товарів в корзині!<br>";
            return $this->error;
        }
        $address = $data['address'];
        $phone = $data['phone'];
        $query = 
        "insert into orders (user_id, address, phone) values ('$userid','$address','$phone')";
        $DB = new Database();
        $res = $DB->write($query);
        if($res){
            $query = "select * from orders order by id DESC";
        $DB = new Database();
        $resd = $DB->read($query)[0];

            $order_id = $resd['id'];
            foreach($cart_data as $item){
                $productid= $item['product_id'];
                $quantity = $item['quantity'];
                $query = "insert into order_item (order_id, product_id, quantity) values ('$order_id','$productid','$quantity')";
                $DB = new Database();
                $res = $DB->write($query);
            }
        }
        else{
            $this->error .= "Не вдалося зробити замовлення. <br>";
            return  $this->error;
        }
    }
    public function remove_order($orderid){
        $DB=new Database();
        $query = "DELETE FROM order_item where order_id='$orderid'";
        $res = $DB->write($query);

        $DB=new Database();
        $query = "DELETE FROM orders where id='$orderid'";
        $res = $DB->write($query);
        
    }
    public function get_all_data(){
        $DB=new Database();
        $query = "SELECT * FROM orders";
        $res = $DB->read($query);
        if(!$res){
            return false;
        }
        return $res;
    }
    public function get_sum($orderid){
        $res = $this->get_data_order($orderid);
        $items = $this->get_items($orderid);

        $sum = 0;
        if(is_bool($res)){
            return 0;
        }
        foreach($items as $item){
            $product = new Product();
            $item_price = $product->get_data($item['product_id'])['price'];
            $sum = $sum + $item['quantity'] * $item_price;
        }
        return $sum;
    }
}