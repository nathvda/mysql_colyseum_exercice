<?php

require '../validators/ClientValidator.php';

if($_POST['submit']){

    $user = new ClientValidator($_POST);
    $errors = $user->validate_user();  

    header('Location: ../public/see_clients.php');
    exit();
}

