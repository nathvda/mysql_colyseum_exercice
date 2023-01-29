<?php

require '../validators/ShowValidator.php';

if($_POST['submit']){

    $user = new ShowValidator($_POST);
    $errors = $user->validate_show();

    header('Location: ../public/see_shows.php');
    exit();
}
