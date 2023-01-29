<?php
include '../model/Dbconnect.php';

class Users extends DbConnect { 

    protected function getAllUsers(){

        try {
            $sql = "SELECT id, username FROM users";
    
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
    
            $results = $stmt->fetchAll();
    
            return $results;
    
    }  catch (Exception $e) {
    
            echo 'couldnt connect to db';
    
    }
    
    }

    protected function getUser($username){

        try {
            $sql = "SELECT * FROM users WHERE username = ?";
    
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username]);
    
            $results = $stmt->fetchAll();
    
            return $results;
    
    }  catch (Exception $e) {
    
            echo 'couldnt connect to db';
    
    }
    
    }


    protected function addUser($username, $password){

        try{

            $encr_pw = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

            $prep = $this->connect()->prepare($sql);

            $prep->bindParam(':username', $username);
            $prep->bindParam(':password', $encr_pw );

            $prep->execute();

            var_dump('done');

            } catch (exception $e){
            
            var_dump('rolling back');
            
            }
    }
}