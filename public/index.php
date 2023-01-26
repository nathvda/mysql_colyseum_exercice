<?php
session_start();

if(!isset($_SESSION['logged_in']) OR empty($_SESSION['logged_in'])){
    $_SESSION['logged_in'] = true;
}

var_dump($_SESSION['logged_in']);

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

foreach ($prep->fetchAll(PDO::FETCH_ASSOC) as $enre){
    
    $id = $enre['id'];

    foreach($enre as $enr){
    echo "<a href='../view/update_client.php?id=$id'>";
    echo $enr;
    echo "</a>";

}
    echo '<br/>';
}
$bdd = "";

}

echo "<h2>All clients</h2>";
displayAll("clients");
echo "<h2>All available show types</h2>";
displayAll("showtypes");
echo "<h2>20 first clients</h2>";
displayAll("clients", 20);

/**
 * @params
 *        $from = table
 *        $where = condition
 */


function joinAndDisplayAll($from,$where = NULL){

    $bdd = new DbConnect();
    $bdd = $bdd->connect();
    
    $sql = "SELECT * FROM $from INNER JOIN cards ON $from.cardNumber = cards.cardNumber";
    
    if ($where != NULL){
        $sql .= " WHERE $where";
    }
    
    $prep = $bdd->prepare($sql);
    $prep->execute();
    
    foreach ($prep->fetchAll(PDO::FETCH_ASSOC) as $enre){
        foreach($enre as $enr){
    
        echo $enr;
    }
        echo '<br/>';
    }

    $bdd = "";
    
}

    echo "<h2>People with fidelity card</h2>";

    joinAndDisplayAll('clients', 'cardTypesId = 1');
    

    function sortAndTrim($from,$letter){

        $bdd = new DbConnect();
        $bdd = $bdd->connect();
        
        $sql = "SELECT lastName,firstName FROM $from WHERE lastName LIKE '$letter%' ORDER BY lastName ASC";
        
        $prep = $bdd->prepare($sql);
        $prep->execute();
        
        foreach ($prep->fetchAll(PDO::FETCH_ASSOC) as $enre){
            echo 'Nom: <b>' . $enre['lastName'] . '</b><br/>';
            echo 'Prénom: <b>' . $enre['firstName'] . '</b><br/><br/>';
        }

        $bdd = "";
        
    }

    echo "<h2>People with names in M</h2>";

    sortAndTrim('clients','M');

    function displayshow($from){

        $bdd = new DbConnect();
        $bdd = $bdd->connect();
        
        $sql = "SELECT id,title,performer,date,startTime FROM $from";
        

        
        $prep = $bdd->prepare($sql);
        $prep->execute();
        
        foreach ($prep->fetchAll(PDO::FETCH_ASSOC) as $enre){
            $id = $enre['id'];
            $title = $enre['title'];
            $performer = $enre['performer'];
            $date = $enre['date'];
            $startTime = $enre['startTime'];

            echo "<i><a href='../view/update_show.php?id=$id'>$title</i></a> par <b>$performer</b>, le $date à $startTime";
            echo '<br/>';
        }

        $bdd = "";
        
}

        echo "<h2>Scheduled shows</h2>";

        displayshow('shows');


        function displayFullClients($from){

            $bdd = new DbConnect();
            $bdd = $bdd->connect();
            
            $sql = "SELECT * FROM $from LEFT Join cards ON clients.cardNumber = cards.cardNumber LEFT JOIN cardtypes ON cards.cardTypesId = cardtypes.id";
            
    
            
            $prep = $bdd->prepare($sql);
            $prep->execute();
            
            foreach ($prep->fetchAll(PDO::FETCH_ASSOC) as $enre){
                $lastName= $enre['lastName'];
                $firstName = $enre['firstName'];
                $birthDate = $enre['birthDate'];
                
                
                if ($enre['type'] == "Fidélité"){
                    $card = "oui";
                    $number = $enre['cardNumber'];
                } else {
                    $card = "non";
                    $number = "-";
                }
    
                echo "<p>Nom : <b>$lastName</b> <br/>
                Prénom : <b>$firstName</b>  <br/>
                Date de naissance : <b>$birthDate</b> <br/>
                Carte de fidélité : <b>$card</b> <br/>
                Numéro de carte : <b>$number</b> </p><br/>
                ";
            }
    
            $bdd = "";

}
    
            echo "<h2>Display all clients</h2>";
    
            displayFullClients('clients');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="./assets/scss/style.css">
</head>
<body>
    <nav><?php
    if ($_SESSION['logged_in'] == true){

    echo '<a href="../view/add_client.php">Ajouter un client</a>';
    echo '<a href="../view/add_show.php">Ajouter un spectacle</a>';
    } else { 
    echo  '<a href="../log_in.php">Me connecter</a>';
    }

    ?></nav>

    <?php displayShow('shows'); 

    ?>
    
</body>
</html>