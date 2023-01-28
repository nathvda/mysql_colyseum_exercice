<?php
session_start();

if (!isset($_SESSION['logged_in']) or empty($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = false;
}

require '../controller/sql_connect.php';
require '../dump.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theatre Colyseum - Page d'accueil</title>
    <link rel="stylesheet" href="./assets/scss/style.css">
    <script defer src="./assets/scripts/main.js" type="module"></script>
</head>

<body>
    <nav><?php
            if ($_SESSION['logged_in'] == true) {

                echo '<a href="../public/index.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
    </svg></a>';
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

    <section class="hero">
            <div class="hero_text">
            <h3>A new culture</h3>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                Necessitatibus perferendis laborum amet eos similique nemo alias aspernatur
                error ducimus laboriosam facilis, mollitia impedit labore reprehenderit
                accusantium, quisquam repudiandae sed? Saepe!
            </div>
            <div class="hero_image">
            <h3>A new culture</h3>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                Necessitatibus perferendis laborum amet eos similique nemo alias aspernatur
                error ducimus laboriosam facilis, mollitia impedit labore reprehenderit
                accusantium, quisquam repudiandae sed? Saepe!
            </div>
    </section>

    <section class='shows-section'>
        <h2>Scheduled shows</h2>

        <?php displayShow('shows');

        ?>
    </section>

</body>

</html>