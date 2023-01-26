<?php
require '../view/check_logged_in.php';
require '../controller/client_validator.php';
require '../controller/sql_connect.php';

var_dump($_SESSION['logged_in']);

function add_user(){

    $user = new client_validator($_POST);
    $errors = $user->validate_user();

    if(count($errors) == 0){
    
    $bdd = new DbConnect();
    $bdd = $bdd->connect();

    try {   

    $bdd->beginTransaction();
        
    if ($_POST['fidelityCard'] == 1){

    $sql1 = "INSERT INTO clients (lastName,firstName,birthDate,card,cardNumber) VALUES (:lastName, :firstName, :birthDate, :fidelityCard, :cardNumber)";

    $prep1 = $bdd->prepare($sql1);

    $prep1->bindParam(':lastName', $_POST['lastName']);
    $prep1->bindParam(':firstName', $_POST['firstName']);
    $prep1->bindParam(':birthDate', $_POST['birthDate']);
    $prep1->bindParam(':fidelityCard', $_POST['fidelityCard']);
    $prep1->bindParam(':cardNumber', $_POST['cardNumber']);

    $prep1->execute();

    } else {

    $sql1 = "INSERT INTO clients (lastName,firstName,birthDate,card,cardNumber) VALUES (:lastName, :firstName, :birthDate, :fidelityCard, NULL)";

    $prep1 = $bdd->prepare($sql1);

    $prep1->bindParam(':lastName', $_POST['lastName']);
    $prep1->bindParam(':firstName', $_POST['firstName']);
    $prep1->bindParam(':birthDate', $_POST['birthDate']);
    $prep1->bindParam(':fidelityCard', $_POST['fidelityCard']);

    $prep1->execute();

    }
    
    if($_POST['fidelityCard'] == 1){ 
        
    $sql = "INSERT INTO cards (cardNumber, cardTypesId) VALUES (:cardNumber, :cardType)";
    
    $prep = $bdd->prepare($sql);

    $prep->bindParam(':cardNumber', $_POST['cardNumber']);
    $prep->bindParam(':cardType', $_POST['cardType']);

    $prep->execute();
    }

    $bdd->commit();

} 
catch (exception $e){

    $bdd->rollback();
    echo "rolled back";

}

}
}

if($_SERVER['REQUEST_METHOD'] == "POST"){

    add_user();

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un client</title>
    <link rel="stylesheet" href="../public/assets/scss/style.css">
</head>
<body><header><a href="../public/index.php">Home</a></header>
<h1>Ajouter un nouveau client</h1>
    <main>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div><label for="lastName">Nom:</label>
        <input type="text" id="lastName" name="lastName"></div>
        <div><label for="firstName">Prénom:</label>
        <input type="text" id="firstName" name="firstName"></div>
        <div><label for="birthDate">Date de naissance:</label>
        <input type="date" id="birthDate" name="birthDate"></div>
        <div><label for="fidelityCard">Carte de fidélité:</label>
        <p><label for="oui">Oui</label>
        <input type="radio" name="fidelityCard" id="oui" value="true" required checked></p>
        <p><label for="non">Non</label>
        <input type="radio" name="fidelityCard" id="non" value="false"></div></p></div>
        <div><label for="cardType">Type de carte: </label>
        <p><label for="fidelite">Fidélité</label>
        <input type="radio" name="cardType" id="fidelite" value="fidelite" required checked></p>
        <p><label for="famille">Famille Nombreuse</label>
        <input type="radio" name="cardType" id="famille" value="famille" ></p>
        <p><label for="etudiant">Etudiant</label>
        <input type="radio" name="cardType" id="etudiant" value="etudiant"></p>
        <p><label for="employe">Employé</label>
        <input type="radio" name="cardType" id="employe" value="employe"></div></p></div>

        <div><label for="cardNumber">Numéro de carte:</label>
        <input type="text" name="cardNumber" id="cardNumber" value="-"></div>
        <button type="submit" name="submit" value="submit">Ajouter un client</button>
</main>
</form>

</body>
</html>

<?php

check_logged_in();

?>