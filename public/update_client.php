<?php

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    $id = intval($_POST['id']);
}


function fetchClient($id)
{
    include '../view/clientsview.php';

    $cli = new ClientsView();
    $cli = $cli->showClient($id);
    var_dump($cli);

}

fetchClient($id);

?>

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
    <header><a href="../public/index.php">Home</a></header>
    <h1>Modifier un client</h1>
    <main>
        <form method="post" action="../includes/_update_client.php">
            <input style="display:none" name="id" type="number" value="<?php echo (isset($_POST['id'])) ? $_POST['id'] : $id; ?>">
            <div><label for="lastName">Nom:</label>
                <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($_SESSION['modifyClient'][0]['lastName']); ?>">
            </div>
            <div><label for="firstName">Prénom:</label>
                <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($_SESSION['modifyClient'][0]['firstName']); ?>">
            </div>
            <div><label for="birthDate">Date de naissance:</label>
                <input type="date" id="birthDate" name="birthDate" value="<?php echo htmlspecialchars($_SESSION['modifyClient'][0]['birthDate']); ?>">
            </div>
            <div><label for="fidelityCard">Carte de fidélité:</label>
                <p><label for="oui">Oui</label>
                    <input type="radio" name="fidelityCard" id="oui" value="true" required <?php echo ($_SESSION['modifyClient'][0]['card'] == 1) ? 'checked' : '' ?>>
                </p>
                <p><label for="non">Non</label>
                    <input type="radio" name="fidelityCard" id="non" value="false" <?php echo ($_SESSION['modifyClient'][0]['card'] == 0) ? 'checked' : '' ?>>
            </div>
            </p>
            </div>

            <div><label for="cardNumber">Numéro de carte:</label>
                <input type="text" name="cardNumber" id="cardNumber" value="<?php echo htmlspecialchars($_SESSION['modifyClient'][0]['cardNumber']); ?>">
            </div>
            <button type="submit" name="submit" value="submit">Modifier le client</button>
        </form>
    </main>

</body>

</html>