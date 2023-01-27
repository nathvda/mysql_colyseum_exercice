<?php
session_start();

include '../controller/user_register.php';

function register(){ 

    $user = new user_register($_POST);
    $errors = $user->validate_login();
    var_dump($errors);
    


}

if(isset($_POST['submit'])){
    register();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Colyseum - S'enregistrer</title>
    <link rel="stylesheet" href="../public/assets/scss/style.css">
</head>

<body>
    <h2>S'enregistrer</h2>
    <main>
        <form method="post" action"">
            <div>
                <label id="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username">
            </div>
            <div> <label id="password">Mot de passe</label>
                <input type="password" id="password" name="password">
            </div>
            <div><label id="confirmpassword">Confirmer le mot de passe</label>
                <input type="password" id="confirmpassword" name="confirmpassword">
            </div>
            <button type="submit" name="submit" value="submit">M'inscrire</button>
        </form>
    </main>
</body>

</html>

<?php

if ($_SESSION['logged_in'] == true) {
    header('Location: ./index.php');
    exit();
}

?>