<?php

include '../model/Dbconnect.php';

class Bookings extends DbConnect{

    protected function getSelectedBookings($id){

        $sql = "SELECT * FROM bookings WHERE id = ?";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetchAll();
        
        return $result;

        

    }


    protected function deleteBooking($id){
        
        $sql = "DELETE FROM bookings WHERE id = ?";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        
    }

}