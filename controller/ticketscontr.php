<?php
include '../model/Tickets.php';

class Ticketscontr extends Tickets{

    public function deleteTickets($ids){

    foreach ($ids as $id){

        $bkg = new Tickets();
        $bkg->deleteTickets($id);
    }

    }
}
?>