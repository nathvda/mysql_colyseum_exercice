<?php
session_start();

function check_logged_in(){

    if ($_SESSION['logged_in'] == false){

        return header('Location: ./log_in.php');
        exit();
    }

}

?>