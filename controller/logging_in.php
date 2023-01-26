<?php


function log_in(){

var_dump($_POST);


include '../controller/user_validator.php';

$newUser = new user_validator($_POST);
$errors = $newUser->validate_login();

var_dump($errors);
}




?>