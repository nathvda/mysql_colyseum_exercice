<?php

include '../validators/UserRegister.php';

function register(){ 

    $user = new UserRegister($_POST);
    $errors = $user->validate_register();

    if (count($errors) === 0){
    header('Location: ../public/index.php');    
    exit();
    } else {
    echo "idk";
    }

}

if(isset($_POST['submit'])){
    register();
    

}