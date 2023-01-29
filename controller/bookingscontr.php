<?php
include '../model/Bookings.php';

class Bookingscontr extends Bookings{

    public function deleteBookings($ids){

    foreach ($ids as $id){

        $bkg = new Bookings();
        $bkg->deleteBooking($id);
    }

    }
}
?>