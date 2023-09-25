<?php
class Product {
    private $error = "";
    public function get_categories(){
        $DB= new Database();
        $query = "SHOW COLUMNS FROM product WHERE Field = 'category'";
        $res = $DB->read($query);
        $enum = $res[0]['Type'];
        preg_match("/^enum\(\'(.*)\'\)$/", $enum, $matches);
        $res = explode("','", $matches[1]);
        return $res;
    }
    public function get_data($prodid){
        $DB=new Database();
        $query = "SELECT * FROM product WHERE id='$prodid' limit 1";
        $res = $DB->read($query);
        if(!$res){
            return false;
        }
        return $res[0];
    }
    public function remove_product($productid){
        $DB=new Database();
        $query = "DELETE FROM wishlist WHERE product_id ='$productid'";
        $res = $DB->write($query);

        $DB2=new Database();
        $query2 = "DELETE FROM cart WHERE product_id ='$productid'";
        $res2 = $DB2->write($query2);

        $DB3=new Database();
        $query3 = "DELETE FROM product WHERE id ='$productid'";
        $res3 = $DB3->write($query3);
    }
    public function create_product($data, $files){
        if(empty($data['name-prod'])){
            $this->error .= "Не вдалося додати продукт без назви!<br>";
            return $this->error;
        }
        if(empty($files['image']['name'])){
            $this->error .= "Не вдалося додати продукт без фотографії!<br>";
            return $this->error;
        }

        $folder = "uploads/products/";
        if(!file_exists($folder)){
            mkdir($folder,0777,true);
        }
        $filename = $folder.$this->generate_productid(20).".jpg";
        move_uploaded_file($files['image']['tmp_name'],$filename);
        $photo = $filename;

        $name = $data['name-prod'];
        $category = $data['category'];
        $price = $data['price'];

        $query = "insert into product (name, price, category, photo) values ('$name', '$price', '$category', '$photo')";
        
        $DB = new Database();
        $res = $DB->write($query);

        if($res){
        }
        else{
            $this->error .= "Не вдалося додати продукт. <br>";
            return  $this->error;
        }
    
    }
    public function generate_productid($length){
        $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$text = "";

		for($x = 0; $x < $length; $x++)
		{

			$random = rand(0,61);
			$text .= $array[$random];
		}

		return $text;
    }
    public function get_products($key, $cat, $sort){
        if($sort == "price-desc"||$sort=="name-desc"){
            $direction = 'DESC';
        }
        else{
            $direction = 'ASC';
        }

        if($sort=="price-desc" || $sort=="price-asc"){
            $field = "price";
        }
        else{
            $field="name";
        }

        if($cat == "all"){
            $query = "select * from product where name LIKE '%$key%' order by $field $direction";
        }
        else{
            $query = "select * from product where name LIKE '%$key%' and category = '$cat' order by $field $direction";
        }

        $DB = new Database();
        $res = $DB->read($query);
        if(!$res){
            return false;
        }
        return $res;
    }
    
}