<?php
include '../view/userview.php';

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
    <link rel="stylesheet" href="../public/assets/scss/style.css">
</head>
<body>
    <?php include '../includes/_navigation.php'; ?>
    <main><form method="post" action="../includes/_logging_in.php">
    <div><label for="username">Nom d'utilisateur</label>
    <input type="text" name="username" id="username"></div>
    <div><label for="password">Mot de passe</label>
    <input type="password" name="password" id="password"></div>
    <button type="submit" name="submit" value="me connecter">Me connecter</button>
    </main>
    </form>
    
</body>
</html>

<?php

if (isset($_SESSION['user'])){
    header("Location: ../public/index.php");
    exit();
}