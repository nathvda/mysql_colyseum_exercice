<?php session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord administratif</title>
    <link rel="stylesheet" href="./assets/scss/style.css">
</head>
<body>
    <main class="dashboard"><a href="./index.php">Accueil</a>
    <a href="./add_client.php">Ajouter un client</a>
    <a href="./add_show.php">Ajouter une représentation</a>
    <a href="./see_clients.php">Voir les clients</a>
    <a href="./see_users.php">Voir les utilisateurs enregistrés</a>
</main>
</body>
</html>

<?php

include '../includes/_check_logged_in.php';
check_logged_in();