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

protected function getShow($id){

    try {
        $sql = "SELECT * FROM shows WHERE id = ?";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

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

protected function modifyShow($data){

    $bdd = $this->connect();

    $bdd->beginTransaction();

    try {
    $sql = "UPDATE shows 
    SET title = :title,
    performer = :performer,
    date  = :date,
    showTypesId = :showType,
    firstGenresId = :firstGenre,
    secondGenreId = :secondGenre,
    duration = :duration,
    startTime = :startTime
    WHERE id = :id";

    $stmt = $bdd->prepare($sql);

    $stmt->bindParam(':title', $data['title']);
    $stmt->bindParam(':performer', $data['performer']);
    $stmt->bindParam(':date', $data['date']);
    $stmt->bindParam(':showType', $data['showType']);
    $stmt->bindParam(':firstGenre', $data['firstGenre']);
    $stmt->bindParam(':secondGenre', $data['secondGenre']);
    $stmt->bindParam(':duration', $data['duration']);
    $stmt->bindParam(':startTime', $data['startTime']);
    $stmt->bindParam(':id', $data['id']);

    $stmt->execute();

    $bdd->commit();

} catch (exception $e){

    $bdd->rollback();
    echo "rolling back";
}

}
}