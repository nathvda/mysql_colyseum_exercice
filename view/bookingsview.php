<?php
include '../model/Bookings.php';

class BookingsView extends Bookings{

    public function showSelectedBookings($ids){

        foreach($ids as $id){

        $bkgs = new Bookings();
        $result = $bkgs->getSelectedBookings($id);

        foreach($result as $res){
            echo '<form method="post">
            <label for="clientId">Numéro de réservation</label>
            <input type="text" id="clientId" name="clientId" value="';
            echo $res['clientId'];
            echo '"/>';
            echo '<label for="clientId">Numéro client</label>
            <input type="text" id="clientId" name="clientId" value="';
            echo $res['clientId'];
            echo '"/>';
            echo '</form>';
        
            $_SESSION['toDelete'][] = $res['clientId'];
        }
    }

    }


}