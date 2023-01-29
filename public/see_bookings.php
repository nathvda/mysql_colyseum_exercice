<?php

include '../includes/_see_bookings.php';

if(isset($_POST['submit'])){
if ($_POST['submit'] === 'search'){

    fetchBookings($_POST['delete']);

    var_dump($_SESSION['toDelete']);
}

if ($_POST['submit'] === 'delete'){

    deleteSelectedBookings($_SESSION['toDelete']);

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
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> " method="post">
<label for="delete">Quelle réservations voulez vous afficher?</label>

<input type="text" name="delete" id="delete" value="<?php echo (isset($_POST['delete'])) ?  $_POST['delete'] : '' ?>"/>

<button type="submit" name="submit" value="search">Voir les réservations</button>
<button type="submit" name="submit" value="delete">supprimer les entrées affichées</button>
</form>
</body>
</html>



