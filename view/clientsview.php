<?php
namespace App\ClientsView;

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
        <th>Numéro de carte</th>
        </tr>
        </thead>';

        foreach ($result as $enre){

            echo '<tr>';

            $lastName = $enre['lastName'];
            $firstName = $enre['firstName'];
            $birthDate = $enre['birthDate'];
            $id = $enre['id'];
            $cardNumber = $enre['cardNumber'];

                        if ($enre['card'] === 0 ){
                            $card = "non";
                        } else {
                            $card = "oui";
                        }

            echo "<td><a href='../public/update_client.php?id=$id'><b>$lastName</b></a></td>
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

        $_SESSION['modifyClient'] = $result;

    }

    public function showSelectedClients($ids){

        foreach($ids as $id){

        $bkgs = new Clients();
        $result = $bkgs->getClient($id);

        foreach($result as $res){
            echo '<form>';

    echo '<label id="id">Numéro client:</label>
    <input type="text" value="';
    echo $res['id'];
    echo '">';
    
    echo '<label id="lastName">Nom:</label>
    <input type="text" value="';
    echo $res['lastName'];
    echo '">';

    echo '<label id="firstName">Prénom:</label>
    <input type="text" value="';
    echo $res['firstName'];
    echo '">';

    echo '<label id="birthDate">Date de naissance:</label>
    <input type="date" value="';
    echo $res['birthDate'];
    echo '">';

    echo '<label id="fidelityCard">Carte de fidélité:</label>
    <input type="checkbox"';
    echo ($res['card'] === 1) ? 'checked=checked' : '';
    echo ">";

    echo '<label id="cardNumber">Numéro de carte de fidélité:</label>
    <input type="number" value="';
    echo $res['cardNumber'];
    echo '">';        
    echo '</form>';
        
            $_SESSION['toDelete'][] = $res['id'];
        }
    }

    }


}