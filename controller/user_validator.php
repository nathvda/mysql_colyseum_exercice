<?php

class user_validator{

    private $data;
    private static $fields = ["username", "password"];
    private $errors = [];

    function __construct($post_data){
        $this->data = $post_data;
    }

    public function validate_login(){
        foreach(self::$fields as $field){
            if(!array_key_exists($field, $this->data)){
                trigger_error("$field does not exist in data");
                return;
            }
        }

        $this->validateuserName();
        $this->validatePassword();
        $this->checkPassword();

        return $this->errors;
    }

    private function validateuserName(){
        $val = trim($this->data['username']);
        $val = stripslashes($val);
        $val = htmlspecialchars(($val));

        if(empty($val)){
            $this->addError('username', 'username cannot be empty');
        } else {
            if (!preg_match('/^[a-zA-Z0-9]{3,}$/',$val)){
                $this->addError('username', 'username must be at least 8 chars and alphanumeric');
            } else {
                $this->data['username'] = $val ;
            }
        }
    }

    private function validatePassword(){
        $val = trim($this->data['password']);
        $val = stripslashes($val);
        $val = htmlspecialchars(($val));

        if(empty($val)){
            $this->addError('password', 'password cannot be empty');
        } else {
            if (!preg_match('/^[a-zA-Z0-9)(]{8,}$/',$val)){
                $this->addError('password', 'password must be at least 8 chars and alphanumeric');
            } else {
                $this->data['password'] = $val ;
            }
        }

    }

    private function checkPassword(){

        require '../controller/sql_connect.php';

        $bdd = new DbConnect();
        $bdd = $bdd->connect();

        $val = $this->data['username'];
        $sql = "SELECT * FROM users WHERE username='$val'"; 
        $infos = $bdd->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        var_dump($this->data['password']);
        var_dump($infos[0]['password']);

        if(password_verify($this->data['password'], $infos[0]['password'])){

            $_SESSION['logged_in'] = true;

        } else {
            $_SESSION['logged_in'] = false;
            $this->addError('password', "wrong password");
        }

    }


    private function addError($key,$value){
        $this->errors[$key] = $value;

    }

}


?>