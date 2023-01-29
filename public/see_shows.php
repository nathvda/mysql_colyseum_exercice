<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="../public/assets/scss/style.css">
    <script defer src="../public/assets/scripts/main.js" type="module"></script>
</head>

<body>
    <nav class="header__nav">
        <?php include '../includes/_navigation.php'; ?>
    </nav>

    <section class='shows-section'>
        <h2>Scheduled shows</h2>
        <?php include '../includes/_shows.php'; ?>
    </section>
    <?php include "../includes/_footer.php"; ?>
</body>

</html>

<?php

include '../includes/_check_logged_in.php';
check_logged_in();