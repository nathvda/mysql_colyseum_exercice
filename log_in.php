<?php



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Authentification</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

    <div><label for="username">Nom d'utilisateur</label>
    <input type="text" name="username" id="username"></div>
    <div><label for="password">Mot de passe</label>
    <input type="password" name="password" id="password"></div>

    </form>
    
</body>
</html>

<?php

if($_SESSION['logged_in'] == true){
    header('Location: index.php');
    exit();
}


?>