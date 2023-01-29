<?php

include '../model/Users.php';

class Userview extends Users {

    public function fetchUser($username){

        $result = $this->getUser($username);

        return $result;

    }

    public function connectUser($username, $password){
        $result = $this->getUser($username);

        if(password_verify($password, $result[0]['password'])){

            session_start();

            $_SESSION['user'] = $result[0]['username'];
            $_SESSION['role'] = $result[0]['role_id'];

        } else {

            $_SESSION['logged_in'] = false;

        }

    }

    public function showAllUsers(){
        $result = $this->getAllUsers();

        foreach($result as $res){
            echo $res['id'];
            echo '<br/>';
            echo $res['username'];
            echo '<br/>';
            echo '<br/>';
        }
    }

}