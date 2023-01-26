<?php

require '../view/check_logged_in.php';
require '../controller/show_validator.php';
include '../controller/sql_connect.php';

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
} else {
    $id = intval($_POST['id']);
}

var_dump($_SESSION['logged_in']);

function fetchUsers($table, $sessionName){

    $bdd = new DbConnect();
    $bdd = $bdd->connect();

    $sql = "SELECT * FROM $table";

    $prep = $bdd->prepare($sql);

    $prep->execute();

    $_SESSION[$sessionName] = $prep->fetchAll(PDO::FETCH_ASSOC);

    foreach($prep->fetchAll(PDO::FETCH_ASSOC) as $line){
        echo $line['lastName'];
    }
}

fetchUsers('shows', 'showsfetched');


function update_show(){

    $user = new show_validator($_POST);
    $errors = $user->validate_show();

    if(count($errors) == 0){
    
    $bdd = new DbConnect();
    $bdd = $bdd->connect();

    try {   

    $bdd->beginTransaction();
    
    $sql1 = "UPDATE shows 
    SET title = :title,
    performer = :performer,
    date  = :date,
    showTypesId = :showType,
    firstGenresId = :firstGenre,
    secondGenreId = :secondGenre,
    duration = :duration,
    startTime = :startTime
    WHERE id = :id";

    $prep1 = $bdd->prepare($sql1);

    $prep1->bindParam(':title', $_POST['title']);
    $prep1->bindParam(':performer', $_POST['performer']);
    $prep1->bindParam(':date', $_POST['date']);
    $prep1->bindParam(':showType', $_POST['showType']);
    $prep1->bindParam(':firstGenre', $_POST['firstGenre']);
    $prep1->bindParam(':secondGenre', $_POST['secondGenre']);
    $prep1->bindParam(':duration', $_POST['duration']);
    $prep1->bindParam(':startTime', $_POST['startTime']);
    $prep1->bindParam(':id', $_POST['id']);

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

    update_show();

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un  spectacle</title>
    <link rel="stylesheet" href="../public/assets/scss/style.css">
</head>
<body><header><a href="../public/index.php">Home</a></header>
<h1>Modifier un spectacle</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <input type="number" name="id" value="<?php echo (isset($_POST['id'])) ? $_POST['id'] : $_GET['id'];?>">
        <div><label for="title">Nom du spectacle:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($_SESSION['showsfetched'][$id-1]['title']);?>"></div>
        <div><label for="performer">Artiste:</label>
        <input type="text" id="performer" name="performer" value="<?php echo htmlspecialchars($_SESSION['showsfetched'][$id-1]['performer']);?>"></div>
        <div><label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($_SESSION['showsfetched'][$id-1]['date']);?>"></div>
        <div><p><label for="cardType">Type de spectacle: </label></p>
        <?php include '../controller/get_all_showtypes.php'; echo displaySelectTypes('showType') ?></p></div>
        <div><p><label for="cardType">Genre principal du spectacle: </label></p>
        <?php include '../controller/get_all_genres.php'; echo displaySelectGenres('firstGenre') ?></p></div>
        <div><p><label for="cardType">Genre secondaire du spectacle: </label></p>
        <?php echo displaySelectGenres('secondGenre') ?></p></div>

        <div><label for="duration">Durée:</label>
        <input type="duration" name="duration" id="duration" value="<?php echo htmlspecialchars($_SESSION['showsfetched'][$id-1]['duration']);?>"></div>
        <div><label for="startTime">Heure de début:</label>
        <input type="duration" name="startTime" id="startTime" value="<?php echo htmlspecialchars($_SESSION['showsfetched'][$id-1]['startTime']);?>"></div>
        <button type="submit" name="submit" value="submit">Modifier un spectacle</button>
</form>

</body>
</html>

<?php

check_logged_in();

?>
