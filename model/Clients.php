<?php
include '../model/Dbconnect.php';

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

    protected function addClient($lastName, $firstName, $birthDate, $fidelityCard, $cardNumber, $cardType){

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

    /**
     * Delete client from db.
     */

    protected function deleteClient($id){

        $sql = "DELETE FROM clients WHERE id = ?";
        
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$id]);
        
    }


    protected function modifyClient($data){

        $bdd = $this->connect();

        $bdd->beginTransaction();

        try {

            

        if ($data['fidelityCard'] == 1) {

        $sql1 = "UPDATE clients
        SET lastName = :lastName,
        firstName = :firstName,
        birthDate = :birthDate,
        card = :fidelityCard,
        cardNumber = :cardNumber 
        WHERE id = :id";

                $prep1 = $bdd->prepare($sql1);

                $prep1->bindParam(':lastName', $data['lastName']);
                $prep1->bindParam(':firstName', $data['firstName']);
                $prep1->bindParam(':birthDate', $data['birthDate']);
                $prep1->bindParam(':fidelityCard', $data['fidelityCard']);
                $prep1->bindParam(':cardNumber', $data['cardNumber']);
                $prep1->bindParam(':id', $id);

                $id = intval($data['id']);

                $prep1->execute();
            } else {


        $sql = "UPDATE clients 
        SET lastName = :lastName,
        firstName = :firstName,
        birthDate = :birthDate,
        card = :fidelityCard,
        cardNumber = NULL
        WHERE id = :id";

                $stmt = $bdd->prepare($sql);

                $stmt->bindParam(':lastName', $data['lastName']);
                $stmt->bindParam(':firstName', $data['firstName']);
                $stmt->bindParam(':birthDate', $data['birthDate']);
                $stmt->bindParam(':fidelityCard', $data['fidelityCard']);
                $stmt->bindParam(':id', $id);

                $id = $data['id'];

                $stmt->execute();
            }

            $bdd->commit();
        } catch (exception $e) {

            $bdd->rollback();
            echo "rolled back down the moooountaiiiin<br/>
    and fell into the seaaaaa it's an error you can seeee<br/>
    and i'm losing my mind.<br/>
    and this error will become longer<br/>
    until I find a solution to this mess<br/>
    Oh unbelievable distress<br/>";
        }
    }



}