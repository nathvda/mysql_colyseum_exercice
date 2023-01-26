<?php

require '../view/check_logged_in.php';
require '../controller/show_validator.php';
include '../controller/sql_connect.php';

var_dump($_SESSION['logged_in']);

function add_show(){

    $user = new show_validator($_POST);
    $errors = $user->validate_show();

    if(count($errors) == 0){
    
    $bdd = new DbConnect();
    $bdd = $bdd->connect();

    try {   

    $bdd->beginTransaction();
    
    $sql1 = "INSERT INTO shows (title, performer, date, showTypesId, firstGenresId, secondGenreId, duration, startTime) VALUES (:title, :performer, :date, :showType, :firstGenre, :secondGenre, :duration, :startTime)";

    $prep1 = $bdd->prepare($sql1);

    $prep1->bindParam(':title', $_POST['title']);
    $prep1->bindParam(':performer', $_POST['performer']);
    $prep1->bindParam(':date', $_POST['date']);
    $prep1->bindParam(':showType', $_POST['showType']);
    $prep1->bindParam(':firstGenre', $_POST['firstGenre']);
    $prep1->bindParam(':secondGenre', $_POST['secondGenre']);
    $prep1->bindParam(':duration', $_POST['duration']);
    $prep1->bindParam(':startTime', $_POST['startTime']);

    $prep1->execute();

    $bdd->commit();

} 

catch (exception $e){
    $bdd->rollback();
    echo "rolled back";
}

}
}

if($_SERVER['REQUEST_METHOD'] == "POST"){

    add_show();

}


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
<body><header><a href="../public/index.php">Home</a></header>
<h1>Ajouter un nouveau spectacle</h1>
    <main><form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div><label for="title">Nom du spectacle:</label>
        <input type="text" id="title" name="title"></div>
        <div><label for="performer">Artiste:</label>
        <input type="text" id="performer" name="performer"></div>
        <div><label for="date">Date:</label>
        <input type="date" id="date" name="date"></div>
        <div><p><label for="cardType">Type de spectacle: </label></p>
        <?php include '../controller/get_all_showtypes.php'; echo displaySelectTypes('showType') ?></div>
        <div><p><label for="cardType">Genre principal du spectacle: </label></p>
        <?php include '../controller/get_all_genres.php'; echo displaySelectGenres('firstGenre') ?></div>
        <div><p><label for="cardType">Genre secondaire du spectacle: </label></p>
        <?php echo displaySelectGenres('secondGenre') ?></div>

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
