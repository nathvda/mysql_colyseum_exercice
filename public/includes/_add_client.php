<?php

require '../../dump/client_validator.php';
include '../../controller/clientscontr.php';

if($_POST['submit']){

    $user = new client_validator($_POST);
    $errors = $user->validate_user();
    
    $client = new Clientscontr();
    $client->createClient($_POST);    
}
