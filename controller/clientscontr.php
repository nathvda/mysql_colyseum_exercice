<?php

include '../../model/Clients.php';

class Clientscontr extends Clients{

    public function createClient($data){
        $this->addClient($data['lastName'], $data['firstName'], $data['birthDate'], $data['fidelityCard'], $data['cardNumber'], $data['cardType']);
    }

}