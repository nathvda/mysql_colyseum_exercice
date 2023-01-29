<?php
session_start();
include '../includes/_check_logged_in.php';
include '../includes/_get_all_genres.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un nouveau spectacle</title>
    <link rel="stylesheet" href="../public/assets/scss/style.css">
</head>
<body><header><a href="../public/admin_dashboard.php">Retourner au panneau d'administration</a></header>
<h1>Ajouter un nouveau spectacle</h1>
    <main><form method="post" action="../includes/_add_show.php">
        <div><label for="title">Nom du spectacle:</label>
        <input type="text" id="title" name="title"></div>
        <div><label for="performer">Artiste:</label>
        <input type="text" id="performer" name="performer"></div>
        <div><label for="date">Date:</label>
        <input type="date" id="date" name="date"></div>
        <div><p><label for="cardType">Type de spectacle: </label></p>
        <?php drop_list_showtypes('showType') ?></div>
        <div><p><label for="cardType">Genre principal du spectacle: </label></p>
        <?php drop_list_genres('firstGenre') ?></div></div>
        <div><p><label for="cardType">Genre secondaire du spectacle: </label></p>
        <?php drop_list_genres('secondGenre') ?></div></div>

        <div><label for="duration">Durée:</label>
        <input type="duration" name="duration" id="duration" value=""></div>
        <div><label for="startTime">Heure de début:</label>
        <input type="duration" name="startTime" id="startTime" value=""></div>
        <button type="submit" name="submit" value="submit">Ajouter un spectacle</button>
    </main> 
</form>

</body>
</html>

<?php

check_logged_in();

?>
