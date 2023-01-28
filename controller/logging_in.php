<?php


function log_in(){

include '../controller/user_validator.php';

$newUser = new user_validator($_POST);
$errors = $newUser->validate_login();

}




?>