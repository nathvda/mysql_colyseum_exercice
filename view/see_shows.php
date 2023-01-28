<?php
session_start();

if(!isset($_SESSION['logged_in']) OR empty($_SESSION['logged_in'])){
    $_SESSION['logged_in'] = false;
}


require '../controller/sql_connect.php';

function displayshow($from){

        $bdd = new DbConnect();
        $bdd = $bdd->connect();
        
        $sql = "SELECT id,title,performer,date,startTime FROM $from";
        

        
        $prep = $bdd->prepare($sql);
        $prep->execute();

        echo "<div class='shows__wrapper'>";
        
        foreach ($prep->fetchAll(PDO::FETCH_ASSOC) as $enre){
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="../public/assets/scss/style.css">
    <script defer src="../public/assets/scripts/main.js" type="module"></script>
</head>
<body>
    <nav><?php
    if ($_SESSION['logged_in'] == true){

    echo '<a href="../view/add_client.php">Ajouter un client</a>';
    echo '<a href="../view/add_show.php">Ajouter un spectacle</a>';
    echo '<a href="../view/see_clients.php">Voir les clients</a>';
    echo '<a href="../view/see_shows.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
    </svg></a>';
    echo '<a href="../view/log_out.php">Me déconnecter</a>';
    } else { 
    echo  '<a href="../view/log_in.php">Me connecter</a>';
    echo '<a href="../view/register_user.php">Créer un compte</a>';
    }
    
    ?></nav>

<header><h1>COLYSEUM THEATRE</h1></header>

<section class='shows-section'><h2>Scheduled shows</h2>

    <?php displayShow('shows'); 

    ?>
</section>
    
</body>
</html>