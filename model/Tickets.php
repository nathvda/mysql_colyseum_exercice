<?php

include '../model/Dbconnect.php';

class Tickets extends DbConnect{

    protected function getSelectedTickets($id){

        $sql = "SELECT * FROM tickets WHERE bookingsId = ?";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetchAll();
        
        return $result;

        

    }


    protected function deleteTickets($id){
        
        $sql = "DELETE FROM tickets WHERE bookingsId = ?";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        
    }

}