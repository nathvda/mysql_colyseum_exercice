<?php

function displayAll($from, $limit = NULL, $where = NULL, $offset = NULL)
{

    $bdd = new DbConnect();
    $bdd = $bdd->connect();

    $sql = "SELECT * FROM $from";

    if ($where != NULL) {
        $sql .= " WHERE $where";
    }

    if ($limit != NULL) {
        $sql .= " LIMIT $limit";
    }

    if ($offset != NULL) {
        $sql .= " OFFSET $offset";
    }

    $prep = $bdd->prepare($sql);
    $prep->execute();

    foreach ($prep->fetchAll(PDO::FETCH_ASSOC) as $enre) {

        $id = $enre['id'];

        foreach ($enre as $enr) {
            echo "<a href='../view/update_client.php?id=$id'>";
            echo $enr;
            echo "</a>";
        }
        echo '<br/>';
    }
    $bdd = "";
}


function joinAndDisplayAll($from, $where = NULL)
{

    $bdd = new DbConnect();
    $bdd = $bdd->connect();

    $sql = "SELECT * FROM $from INNER JOIN cards ON $from.cardNumber = cards.cardNumber";

    if ($where != NULL) {
        $sql .= " WHERE $where";
    }

    $prep = $bdd->prepare($sql);
    $prep->execute();

    foreach ($prep->fetchAll(PDO::FETCH_ASSOC) as $enre) {
        foreach ($enre as $enr) {

            echo $enr;
        }
        echo '<br/>';
    }

    $bdd = "";
}

function sortAndTrim($from, $letter)
{

    $bdd = new DbConnect();
    $bdd = $bdd->connect();

    $sql = "SELECT lastName,firstName FROM $from WHERE lastName LIKE '$letter%' ORDER BY lastName ASC";

    $prep = $bdd->prepare($sql);
    $prep->execute();

    foreach ($prep->fetchAll(PDO::FETCH_ASSOC) as $enre) {
        echo 'Nom: <b>' . $enre['lastName'] . '</b><br/>';
        echo 'Prénom: <b>' . $enre['firstName'] . '</b><br/><br/>';
    }

    $bdd = "";
}

function displayshow($from)
{

    $bdd = new DbConnect();
    $bdd = $bdd->connect();

    $sql = "SELECT id,title,performer,date,startTime FROM $from";



    $prep = $bdd->prepare($sql);
    $prep->execute();

    echo "<div class='shows__wrapper'>";

    foreach ($prep->fetchAll(PDO::FETCH_ASSOC) as $enre) {
        $id = $enre['id'];
        $title = $enre['title'];
        $performer = $enre['performer'];
        $date = $enre['date'];
        $startTime = $enre['startTime'];

        echo "<div class='card'><h3><a href='../view/update_show.php?id=$id'>$title</h3></a> par <b>$performer</b>, <span class='date'>$date</span> à $startTime</div>";
    }

    echo "</div>";

    $bdd = "";
}
?>
