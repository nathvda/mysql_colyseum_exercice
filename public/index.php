<?php
require '../dump.php';

include './includes/_check_logged_in.php';

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Theatre Colyseum - Page d'accueil</title>
        <link rel="stylesheet" href="./assets/scss/style.css">
        <script defer src="./assets/scripts/main.js" type="module"></script>
    </head>
    <body>
        <nav class="header__nav">
            <?php include './includes/_navigation.php'; ?>
        </nav>
        <section class="hero">
                <div class="hero_text">
                <h3>A new culture</h3>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                    Necessitatibus perferendis laborum amet eos similique nemo alias aspernatur
                    error ducimus laboriosam facilis, mollitia impedit labore reprehenderit
                    accusantium, quisquam repudiandae sed? Saepe!
                </div>
                <div class="hero_image">
                <img src="./assets/images/theatre.webp" alt="theatre">
                </div>
        </section>
        <section class='shows-section'>
            <h2>Scheduled shows</h2>
            <?php include './includes/_shows.php'; ?>
        </section>
        <?php include "./includes/_footer.php"; ?>
    </body>

</html>

<?php
check_logged_in();