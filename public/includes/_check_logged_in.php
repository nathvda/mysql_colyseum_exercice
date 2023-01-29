<?php
session_start();

function check_logged_in(){

    if (!isset($_SESSION['user'])){

        return header('Location: ./log_in.php');
        exit();
    }

}

?>