
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un client</title>
    <link rel="stylesheet" href="../public/assets/scss/style.css">
</head>
<body>
<nav class="header__nav">
            <?php include '../includes/_navigation.php'; ?>
        </nav>

    <main>
        <h3>Ajouter un client</h3>
        <form method="post" action="../includes/_add_client.php">
        <div><label for="lastName">Nom:</label>
        <input type="text" id="lastName" name="lastName"></div>
        <div><label for="firstName">Prénom:</label>
        <input type="text" id="firstName" name="firstName"></div>
        <div><label for="birthDate">Date de naissance:</label>
        <input type="date" id="birthDate" name="birthDate"></div>
        <div><label for="fidelityCard">Carte de fidélité:</label>
        <p><label for="oui">Oui</label>
        <input type="radio" name="fidelityCard" id="oui" value="true" required checked></p>
        <p><label for="non">Non</label>
        <input type="radio" name="fidelityCard" id="non" value="false"></div></p></div>
        <div><label for="cardType">Type de carte: </label>
        <p><label for="fidelite">Fidélité</label>
        <input type="radio" name="cardType" id="fidelite" value="fidelite" required checked></p>
        <p><label for="famille">Famille Nombreuse</label>
        <input type="radio" name="cardType" id="famille" value="famille" ></p>
        <p><label for="etudiant">Etudiant</label>
        <input type="radio" name="cardType" id="etudiant" value="etudiant"></p>
        <p><label for="employe">Employé</label>
        <input type="radio" name="cardType" id="employe" value="employe"></div></p></div>

        <div><label for="cardNumber">Numéro de carte:</label>
        <input type="text" name="cardNumber" id="cardNumber" value="-"></div>
        <button type="submit" name="submit" value="submit">Ajouter un client</button>
</main>
</form>
</body>
</html>

<?php

include '../includes/_check_logged_in.php';
check_logged_in();