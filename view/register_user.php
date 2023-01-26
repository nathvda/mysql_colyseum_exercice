<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Colyseum - S'enregistrer</title>
</head>
<body>
    <form method="post" action"">
        <label id="userName"></label>
        <input type="text" id="userName" name="userName">
        <label id="password"></label>
        <input type="password" id="password" name="password">
        <label id="confirmpassword"></label>
        <input type="confirmpassword" id="confirmpassword" name="confirmpassword">
    </form>
</body>
</html>

<?php 

if($_SESSION['logged_in'] == true){
    header('Location: ./index.php');
    exit();
}

?>