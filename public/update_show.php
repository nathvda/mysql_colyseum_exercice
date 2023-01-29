<?php

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
} else {
    $id = intval($_POST['id']);
}

function modifyShow($id){
    include '../view/showsview.php';

    $sw = new Showsview();
    $sw = $sw->showShow($id);

    var_dump($_SESSION['modifyShow']);

}

modifyShow($id);

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
    <main><form method="post" action="../includes/_update_show.php">
        <input style="display:none" type="number" name="id" value="<?php echo (isset($_POST['id'])) ? $_POST['id'] : $_GET['id'];?>">
        <div><label for="title">Nom du spectacle:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($_SESSION['modifyShow'][0]['title']);?>"></div>
        <div><label for="performer">Artiste:</label>
        <input type="text" id="performer" name="performer" value="<?php echo htmlspecialchars($_SESSION['modifyShow'][0]['performer']);?>"></div>
        <div><label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($_SESSION['modifyShow'][0]['date']);?>"></div>
        <div><p><label for="cardType">Type de spectacle: </label></p>
        <?php include '../includes/_get_all_genres.php'; echo drop_list_showtypes('showType') ?></p></div>
        <div><p><label for="cardType">Genre principal du spectacle: </label></p>
        <?php echo drop_list_genres('firstGenre') ?></p></div>
        <div><p><label for="cardType">Genre secondaire du spectacle: </label></p>
        <?php echo drop_list_genres('secondGenre') ?></p></div>

        <div><label for="duration">Durée:</label>
        <input type="duration" name="duration" id="duration" value="<?php echo htmlspecialchars($_SESSION['modifyShow'][0]['duration']);?>"></div>
        <div><label for="startTime">Heure de début:</label>
        <input type="duration" name="startTime" id="startTime" value="<?php echo htmlspecialchars($_SESSION['modifyShow'][0]['startTime']);?>"></div>
        <button type="submit" name="submit" value="submit">Modifier un spectacle</button>
</form>
</main>

</body>
</html>

<?php

include '../includes/_check_logged_in.php';
check_logged_in();

?>
