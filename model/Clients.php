<?php
include '../../model/Dbconnect.php';

class Clients extends DbConnect{


    /**
     * Gets the list of all Clients
     */
    protected function getAllClients(){
        try {
            $sql = "SELECT * FROM clients";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();

            $results = $stmt->fetchAll();

            return $results;

    }  catch (Exception $e) {

            echo 'couldnt connect to db';

    }

}

/**
 * Gets one client by id.
 */

protected function getClient($id){

    try {
        $sql = "SELECT * FROM clients WHERE id = ?";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $results = $stmt->fetchAll();

        return $results;

}  catch (Exception $e) {

        echo 'couldnt connect to db';

}

}

/**
 *  Add one client to the db.
 */

    protected function addClient($firstName, $lastName, $birthDate, $fidelityCard, $cardNumber, $cardType){

        $bdd = $this->connect();
    
        $bdd->beginTransaction();

        try { 
                        
            if ($fidelityCard == 1){
        
            $sql1 = "INSERT INTO clients (lastName,firstName,birthDate,card,cardNumber) VALUES (:lastName, :firstName, :birthDate, :fidelityCard, :cardNumber)";
        
            $prep1 = $bdd->prepare($sql1);
        
            $prep1->bindParam(':lastName', $lastName);
            $prep1->bindParam(':firstName', $firstName);
            $prep1->bindParam(':birthDate', $birthDate);
            $prep1->bindParam(':fidelityCard', $fidelityCard);
            $prep1->bindParam(':cardNumber', $cardNumber);
        
            $prep1->execute();

            $sql = "INSERT INTO cards (cardNumber, cardTypesId) VALUES (:cardNumber, :cardType)";
            
            $prep = $bdd->prepare($sql);
        
            $prep->bindParam(':cardNumber', $cardNumber);
            $prep->bindParam(':cardType', $cardType);
        
            $prep->execute();
        
            } else {
        
            $sql1 = "INSERT INTO clients (lastName,firstName,birthDate,card,cardNumber) VALUES (:lastName, :firstName, :birthDate, :fidelityCard, NULL)";
        
            $prep1 = $bdd->prepare($sql1);
        
            $prep1->bindParam(':lastName', $lastName);
            $prep1->bindParam(':firstName', $firstName);
            $prep1->bindParam(':birthDate', $birthDate);
            $prep1->bindParam(':fidelityCard', $fidelityCard);
        
            $prep1->execute();
        
            }

            $bdd->commit();

            echo "success!";
        
        } 
        catch (exception $e){
        
            $bdd->rollback();
            echo "rolled back";
        
        }

    }



}