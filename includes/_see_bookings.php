<?php
session_start();

function fetchBookings(){

    include '../view/bookingsview.php';

    $_SESSION['toDelete'] = [];

    $infos = explode(",", $_POST['delete']);

    $res = new BookingsView();
    $res = $res->showSelectedBookings($infos);

}

function deleteSelectedBookings($bookings){

    include '../controller/bookingscontr.php';

    $res = new Bookingscontr();
    $res = $res->deleteBookings($bookings);

}



