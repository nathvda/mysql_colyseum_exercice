<?php
include '../validators/clientUpdaterValidator.php';

function updateClient()
{

    $user = new clientUpdaterValidator($_POST);
    $errors = $user->validate_user();

    var_dump($errors);

    if(count($errors) === 0) {
        header('Location: ../public/see_clients.php');
        exit();
    
    } else { 
        var_dump($_POST);

    }
}

if(isset($_POST['submit'])){
    updateClient();
}
