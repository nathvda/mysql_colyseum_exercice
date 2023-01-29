<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="../public/assets/scss/style.css">
</head>
<body>
<nav class="header__nav">
            <?php include '../includes/_navigation.php';?>
        </nav>

<section class="clients">
    
<?php include '../includes/_show_clients.php'; ?>

</section>
</body>

</html>

<?php

include '../includes/_check_logged_in.php';
check_logged_in();