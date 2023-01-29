<?php
include '../model/Users.php';

class Userscontr extends Users{

    public function createUser($data){

        $this->addUser($data['username'], $data['password']);
        
    }

}