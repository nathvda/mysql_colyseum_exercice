<?php

include '../includes/_see_clients.php';

if(isset($_POST['submit'])){
if ($_POST['submit'] === 'search'){

    fetchClients($_POST['delete']);
    
}

if ($_POST['submit'] === 'delete'){

    deleteSelectedClients($_SESSION['toDelete']);

    $_SESSION['toDelete'] = [];
}
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir réservations</title>
    <link rel="stylesheet" href="./assets/scss/style.css">
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



