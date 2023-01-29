<?php
function log_in(){

include '../validators/UserValidator.php';

$user = new UserValidator($_POST);
$user = $user->validate_login();

}

log_in();

    header('Location: ../public/index.php');
    exit();