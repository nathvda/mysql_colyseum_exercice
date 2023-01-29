<?php
include '../model/Dbconnect.php';

class Shows extends DbConnect{

    protected function getAllShows(){

        try {
            $sql = "SELECT * FROM shows";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();

            $results = $stmt->fetchAll();

            return $results;

    }  catch (Exception $e) {

            echo 'couldnt connect to db';

    }

}

}