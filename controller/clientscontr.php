<?php

include '../model/Clients.php';

class Clientscontr extends Clients{

    public function createClient($data){

        $this->addClient($data['lastName'], $data['firstName'], $data['birthDate'], $data['fidelityCard'], intval($data['cardNumber']), $data['cardType']);

    }

    public function deleteClients($ids){

        foreach($ids as $id){
            $cli = new Clients();
            $cli->deleteClient($id);

            var_dump($_SESSION['toDelete']);

        }
    }

}