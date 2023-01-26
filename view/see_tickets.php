<?php
require '../controller/sql_connect.php';

$_SESSION['toDelete'] = [];

function fetchBookings($info){

$bdd = new DbConnect();
$bdd = $bdd->connect();

$infos = explode(",",$info);

foreach ($infos as $info){

    $info = intval($info);

try{ 
    
$sql = "SELECT * FROM tickets WHERE bookingsId = $info";

$prep = $bdd->prepare($sql);
$prep->execute();

foreach($prep->fetchAll(PDO::FETCH_ASSOC) as $line){
    echo '<form method="post">
    <div><label for="id">Numéro  billets</label>
    <input type="text" id="ticketId" name="clientId" value="';
    echo $line['id'];
    echo '"/></div>';
    echo '<div><label for="clientId">Prix</label>
    <input type="text" id="clientId" name="clientId" value="';
    echo $line['price'];
    echo '"/></div>';
    echo '<div><label for="clientId">Numéro de réservation</label>
    <input type="text" id="clientId" name="clientId" value="';
    echo $line['bookingsId'];
    echo '"/></div>';
    echo '</form>';

} 

}
catch (exception $e){
    echo "La réservation $info n'existe pas.";

}

}
}

fetchBookings($_POST['delete']);

function deleteEntries($args){

$args = explode(",", $args);


$bdd = new DbConnect();
$bdd = $bdd->connect();

    $bdd->beginTransaction();

    try{ 

    foreach($args as $arg){

    var_dump($arg);

    $sql = "DELETE FROM tickets WHERE bookingsId = :arg";
    
    $prep = $bdd->prepare($sql);

    $prep->bindParam(':arg', $arg);

    $prep->execute();

    echo "suppression de la réservation $arg réussie<br/>";
}

    $bdd->commit();

} catch (exception $e){
    $bdd->rollBack();
    echo "rolling back";

}


}


if(isset($_POST['delete']) AND $_POST['submit'] === "delete"){
    deleteEntries($_POST['delete']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir réservations</title>
</head>
<body>
<form action="" method="post">
<label for="delete">Quelle réservations voulez vous afficher?</label>
<input type="text" name="delete" id="delete" value="<?php echo (isset($_POST['delete'])) ?  $_POST['delete'] : '' ?>"/>
<button type="submit" name="submit" value="search">Voir les réservations</button>


<form action="" method="post"><button type="submit" name="submit" value="delete">supprimer les entrées affichées</button></form>
</form>
</body>
</html>



