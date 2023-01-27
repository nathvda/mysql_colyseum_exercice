<?php

class user_register{

    private $data;
    private static $fields = ["username", "password", "confirmpassword"];
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
        $this->validateConfirmPassword();
        $this->comparePasswords();

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
                $this->data['password'] = $val;
            }
        }

    }

    private function validateConfirmPassword(){
        $val = trim($this->data['confirmpassword']);
        $val = stripslashes($val);
        $val = htmlspecialchars(($val));

        if(empty($val)){
            $this->addError('confirmpassword', 'confirmpassword cannot be empty');
        } else {
            if (!preg_match('/^[a-zA-Z0-9)(]{8,}$/',$val)){
                $this->addError('confirmpassword', 'confirmpassword must be at least 8 chars and alphanumeric');
            } else {
                $this->data['confirmpassword'] = $val ;
            }
        }

    }

    private function comparePasswords(){    

        if($this->data['password'] === $this->data['confirmpassword']){

            require '../controller/sql_connect.php';

            $pw = password_hash($this->data['password'], PASSWORD_BCRYPT);

            $bdd = new DbConnect();
            $bdd = $bdd->connect();

            try{

            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

            $prep = $bdd->prepare($sql);

            $prep->bindParam(':username', $this->data['username']);
            $prep->bindParam(':password', $pw );

            $prep->execute();

            var_dump('done');

            } catch (exception $e){
            
            var_dump('rolling back');
            $this->addError('username', 'Cet utilisateur existe déjà.');
            
            }

        } else {
        
            $this->addError('password', "Passwords must be the same.");
        }

    }

    private function addError($key,$value){
        $this->errors[$key] = $value;

    }

}


?>