<?php
include '../model/Dbconnect.php';

class Users extends DbConnect { 

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
}