<?php
require '../view/check_logged_in.php';
require '../controller/client_updater_validator.php';
require '../controller/sql_connect.php';

var_dump($_SESSION['logged_in']);

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
} else {
    $id = intval($_POST['id']);
}

function fetchUsers($table, $sessionName){

    $bdd = new DbConnect();
    $bdd = $bdd->connect();

    $sql = "SELECT * FROM $table";

    $prep = $bdd->prepare($sql);

    $prep->execute();

    foreach($prep->fetchAll(PDO::FETCH_ASSOC) as $line){
        echo '<form>';

        echo '<label id="id">Numéro client:</label>
        <input type="text" value="';
        echo $line['id'];
        echo '">';
        
        echo '<label id="lastName">Nom:</label>
        <input type="text" value="';
        echo $line['lastName'];
        echo '">';

        echo '<label id="firstName">Prénom:</label>
        <input type="text" value="';
        echo $line['firstName'];
        echo '">';

        echo '<label id="birthDate">Date de naissance:</label>
        <input type="date" value="';
        echo $line['birthDate'];
        echo '">';

        echo '<label id="fidelityCard">Carte de fidélité:</label>
        <input type="checkbox"';
        echo ($line['card'] === 1) ? 'checked=checked' : '';
        echo ">";

        echo '<label id="cardNumber">Numéro de carte de fidélité:</label>
        <input type="number" value="';
        echo $line['cardNumber'];
        echo '">';        
        echo '</form>';
    }


}

function delete_user(){

    $user = new client_updater_validator($_POST);
    $errors = $user->validate_user();

    if(count($errors) == 0){
    
    $bdd = new DbConnect();
    $bdd = $bdd->connect();

    var_dump($_POST);

    try {   

    $bdd->beginTransaction();
        
    if ($_POST['fidelityCard'] == 1){

        $sql1 = "UPDATE clients
        SET lastName = :lastName,
        firstName = :firstName,
        birthDate = :birthDate,
        card = :fidelityCard,
        cardNumber = :cardNumber 
        WHERE id = :id";

        $prep1 = $bdd->prepare($sql1);

        $prep1->bindParam(':lastName', $_POST['lastName']);
        $prep1->bindParam(':firstName', $_POST['firstName']);
        $prep1->bindParam(':birthDate', $_POST['birthDate']);
        $prep1->bindParam(':fidelityCard', $_POST['fidelityCard']);
        $prep1->bindParam(':cardNumber', $_POST['cardNumber']);
        $prep1->bindParam(':id', $id);

        $id = intval($_POST['id']);

        $prep1->execute();

    } else {

        // $sql = "DELETE FROM cards WHERE cardNumber = :cardNumber";
        
        // $prep = $bdd->prepare($sql);
        
        // $prep->bindParam(':cardNumber', $_POST['cardNumber']);
        
        // $prep->execute();   

        $sql2 = "UPDATE clients 
        SET lastName = :lastName,
        firstName = :firstName,
        birthDate = :birthDate,
        card = :fidelityCard,
        cardNumber = NULL
        WHERE id = :id";

        $prep2 = $bdd->prepare($sql2);

        $prep2->bindParam(':lastName', $_POST['lastName']);
        $prep2->bindParam(':firstName', $_POST['firstName']);
        $prep2->bindParam(':birthDate', $_POST['birthDate']);
        $prep2->bindParam(':fidelityCard', $_POST['fidelityCard']);
        $prep2->bindParam(':id', $id);

        $id = $_POST['id'];

        $prep2->execute();

    }
    
    $bdd->commit();

} 
catch (exception $e){

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

if($_SERVER['REQUEST_METHOD'] == "POST"){

    delete_user();

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un client</title>
    <link rel="stylesheet" href="../public/assets/scss/style.css">
</head>
<body><header><a href="../public/index.php">Home</a></header>
<h1>Supprimer un client</h1>
<?php fetchUsers('clients', 'deleting');?>

</body>
</html>

<?php

check_logged_in();

?>