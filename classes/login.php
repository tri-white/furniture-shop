<?php
class Login{
    private $error="";

    public function evaluate($data){
        foreach($data as $key => $value){
            if(empty($value)){
                $this->error .= "поле " . $key ." пусте!<br>";
            }
        }

        if($this->error!=""){
            return $this->error;
        }

        $corr = $this->correct($data);
        if(!$corr){
            return $this->error;
        }
    }
    public function correct($data){
        $username = $data['username'];
        $pass = $data['password'];
        $query = "SELECT username FROM users WHERE username = '$username'";
        $DB = new Database();
        $res = $DB->read($query);
        if(empty($res)){
            $this->error.="Такого користувача не існує!";
            return false;
        }
        $query2 = "SELECT password FROM users WHERE username = '$username'";
        $res2=$DB->read($query2);
        if($res2[0]['password']!=$pass){
            $this->error.="Неправильний пароль!";
            return false;
        }
        
        $query3= "SELECT * FROM users WHERE username = '$username' limit 1";
        $res3=$DB->read($query3);
        $row=$res3[0];

        // create session data 
        $_SESSION['mystore_userid']= $row['id'];

        return true;
    }

    public function check_login($id){

        $query = "SELECT id FROM users WHERE id = '$id' limit 1";

        $DB = new Database();
        $res = $DB->read($query);
        if($res){
            return true;
        }
        return false;
    }
}