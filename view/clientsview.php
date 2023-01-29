<?php

include '../model/Clients.php';

class ClientsView extends Clients {

    public function showAllClients(){

        $result = $this->getAllClients();

        echo '<table>';
        echo '<thead>
        <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Date de naissance</th>
        <th>Carte de fidélité ?</th>
        <th>CardNumber</th>
        </tr>
        </thead>';

        foreach ($result as $enre){

            echo '<tr>';

            $lastName = $enre['lastName'];
            $firstName = $enre['firstName'];
            $birthDate = $enre['birthDate'];
            $id = $enre['id'];

                if ($enre['card'] == 0 ){
                            $card = "oui";
                            $cardNumber = $enre['cardNumber'];
                        } else {
                            $card = "non";
                            $cardNumber = "-";
                        }

            echo "<td><a href='../view/update_client.php?id=$id'><b>$lastName</b></a></td>
            <td><b>$firstName</b></td>
            <td><b>$birthDate</b></td>
            <td><b>$card</b></td>
            <td><b>$cardNumber</b></td>
            ";

            echo '</tr>';
        }

            echo '<table>';


    }

    public function showClient($id){

        $result = $this->getClient($id);

        var_dump($result);

    }


}