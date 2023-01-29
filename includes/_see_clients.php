<?php
session_start();

function fetchClients(){

    include '../view/clientsview.php';

    $_SESSION['toDelete'] = [];

    $infos = explode(",", $_POST['delete']);

    $res = new ClientsView();
    $res = $res->showSelectedClients($infos);

}

function deleteSelectedClients($clients){

    include '../controller/clientscontr.php';

    $res = new Clientscontr();
    $res = $res->deleteClients($clients);

}

