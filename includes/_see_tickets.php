<?php
session_start();

function fetchTickets(){

    include '../view/ticketsview.php';

    $_SESSION['toDelete'] = [];

    $infos = explode(",", $_POST['delete']);

    $res = new TicketsView();
    $res = $res->showSelectedTickets($infos);

}

function deleteSelectedTickets($tickets){

    include '../controller/ticketscontr.php';

    $res = new Ticketscontr();
    $res = $res->deleteTickets($tickets);

}