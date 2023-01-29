<?php
include '../model/Tickets.php';

class TicketsView extends Tickets{

    public function showSelectedTickets($ids){

        foreach($ids as $id){

        $bkgs = new Tickets();
        $result = $bkgs->getSelectedTickets($id);

        foreach($result as $res){
            echo '<form method="post">
            <div><label for="id">Numéro  billets</label>
            <input type="text" id="bookingsId" name="bookingsId" value="';
            echo $res['id'];
            echo '"/></div>';
            echo '<div><label for="bookingsId">Prix</label>
            <input type="text" id="bookingsId" name="bookingsId" value="';
            echo $res['price'];
            echo '"/></div>';
            echo '<div><label for="bookingsId">Numéro de réservation</label>
            <input type="text" id="bookingsId" name="bookingsId" value="';
            echo $res['bookingsId'];
            echo '"/></div>';
            echo '</form>';
        
            $_SESSION['toDelete'][] = $res['bookingsId'];
        }
    }

    }


}