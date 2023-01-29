<?php
include '../validators/clientUpdaterValidator.php';

function updateClient()
{

    $user = new clientUpdaterValidator($_POST);
    $errors = $user->validate_user();

    if(count($errors) === 0) {
        header('Location: ../public/see_clients.php');
        exit();
    
    } else { 

    }
}

if(isset($_POST['submit'])){
    updateClient();
}
