<?php
session_start();

if(!isset($_SESSION['logged_in']) OR empty($_SESSION['logged_in'])){
    $_SESSION['logged_in'] = false;
}


require '../controller/sql_connect.php';

/** 
 *  @var : gets to db according to params;
 *  @param $from string : name of the table;
 *          $limit int : limit of the sql query;
 *          $where string in 'name = 'value'' form;
 *          $offset int : offset of the query;  
 *  @return null;   
 */

function displayAll($from,$limit = NULL,$where = NULL,$offset = NULL){

$bdd = new DbConnect();
$bdd = $bdd->connect();

$sql = "SELECT * FROM $from";

if ($where != NULL){
    $sql .= " WHERE $where";
}

if ($limit != NULL){
    $sql .= " LIMIT $limit";
}

if ($offset != NULL){
    $sql .= " OFFSET $offset";
}

$prep = $bdd->prepare($sql);
$prep->execute();

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

foreach ($prep->fetchAll(PDO::FETCH_ASSOC) as $enre){


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

$bdd = "";

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="../public/assets/scss/style.css">
</head>
<body>
    <nav><?php
    if ($_SESSION['logged_in'] == true){

    echo '<a href="../view/add_client.php">Ajouter un client</a>';
    echo '<a href="../view/add_show.php">Ajouter un spectacle</a>';
    echo '<a href="../view/see_clients.php">Voir les clients</a>';
    echo '<a href="../view/log_out.php">Me déconnecter</a>';
    } else { 
    echo  '<a href="../view/log_in.php">Me connecter</a>';
    echo '<a href="../view/register_user.php">Créer un compte</a>';
    }
    
    ?></nav>

<header><h1>COLYSEUM THEATRE</h1></header>

<section class='shows-section'><h2>Clients</h2>

    <?php displayAll("clients");

    ?>
</section>
    
</body>
</html>