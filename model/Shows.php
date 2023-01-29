<?php
include '../model/Dbconnect.php';

class Shows extends DbConnect{

    protected function getAllShows(){

        try {
            $sql = "SELECT * FROM shows ORDER BY date";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();

            $results = $stmt->fetchAll();

            return $results;

    }  catch (Exception $e) {

            echo 'couldnt connect to db';

    }
}

    protected function getShowGenres(){

        try {
            $sql = "SELECT * FROM genres";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();

            $results = $stmt->fetchAll();

            return $results;

    }  catch (Exception $e) {

            echo 'couldnt connect to db';

    }

}

protected function getShowTypes(){

    try {
        $sql = "SELECT * FROM showtypes";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();

        return $results;

}  catch (Exception $e) {

        echo 'couldnt connect to db';

}

}

protected function addShow(){

    try {   
        $sql = "INSERT INTO shows (title, performer, date, showTypesId, firstGenresId, secondGenreId, duration, startTime) VALUES (:title, :performer, :date, :showType, :firstGenre, :secondGenre, :duration, :startTime)";
    
        $stmt = $this->connect()->prepare($sql);
    
        $stmt->bindParam(':title', $_POST['title']);
        $stmt->bindParam(':performer', $_POST['performer']);
        $stmt->bindParam(':date', $_POST['date']);
        $stmt->bindParam(':showType', $_POST['showType']);
        $stmt->bindParam(':firstGenre', $_POST['firstGenre']);
        $stmt->bindParam(':secondGenre', $_POST['secondGenre']);
        $stmt->bindParam(':duration', $_POST['duration']);
        $stmt->bindParam(':startTime', $_POST['startTime']);
    
        $stmt->execute();
    } 
    
    catch (exception $e){
        echo "rolled back";

    }
}

}