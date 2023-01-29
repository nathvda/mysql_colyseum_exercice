<?php
function log_in(){

include '../validators/UserValidator.php';

$user = new UserValidator($_POST);
$user = $user->validate_login();

var_dump($user);
}

log_in();

    header('Location: ../public/index.php');
    exit();