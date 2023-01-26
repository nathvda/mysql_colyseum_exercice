<?php
include './check_logged_in.php';
include '../controller/logging_in.php';

if(isset($_POST['submit'])){
    log_in();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Colyseum - Se connecter</title>
</head>
<body>
    <h1>Authentification</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

    <div><label for="username">Nom d'utilisateur</label>
    <input type="text" name="username" id="username"></div>
    <div><label for="password">Mot de passe</label>
    <input type="password" name="password" id="password"></div>
    <button type="submit" name="submit" value="me connecter">Me connecter</button>

    </form>
    
</body>
</html>

<?php

if ($_SESSION['logged_in'] == true){
    header("Location: ../public/index.php");
    exit();
}

?>