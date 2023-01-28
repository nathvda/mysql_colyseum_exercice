<?php
require '../view/check_logged_in.php';
require '../controller/client_updater_validator.php';
require '../controller/sql_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    $id = intval($_POST['id']);
}


function fetchUsers($table, $sessionName)
{

    $bdd = new DbConnect();
    $bdd = $bdd->connect();

    $sql = "SELECT * FROM $table";

    $prep = $bdd->prepare($sql);

    $prep->execute();

    $_SESSION[$sessionName] = $prep->fetchAll(PDO::FETCH_ASSOC);

    foreach ($prep->fetchAll(PDO::FETCH_ASSOC) as $line) {
        echo $line['lastName'];
    }
}

fetchUsers('clients', 'modifying');

function update_user()
{

    $user = new client_updater_validator($_POST);
    $errors = $user->validate_user();

    if (count($errors) == 0) {

        $bdd = new DbConnect();
        $bdd = $bdd->connect();

        var_dump($_POST);

        try {

            $bdd->beginTransaction();

            if ($_POST['fidelityCard'] == 1) {

                $sql1 = "UPDATE clients
        SET lastName = :lastName,
        firstName = :firstName,
        birthDate = :birthDate,
        card = :fidelityCard,
        cardNumber = :cardNumber 
        WHERE id = :id";

                $prep1 = $bdd->prepare($sql1);

                $prep1->bindParam(':lastName', $_POST['lastName']);
                $prep1->bindParam(':firstName', $_POST['firstName']);
                $prep1->bindParam(':birthDate', $_POST['birthDate']);
                $prep1->bindParam(':fidelityCard', $_POST['fidelityCard']);
                $prep1->bindParam(':cardNumber', $_POST['cardNumber']);
                $prep1->bindParam(':id', $id);

                $id = intval($_POST['id']);

                $prep1->execute();
            } else {

                // $sql = "DELETE FROM cards WHERE cardNumber = :cardNumber";

                // $prep = $bdd->prepare($sql);

                // $prep->bindParam(':cardNumber', $_POST['cardNumber']);

                // $prep->execute();   

                $sql2 = "UPDATE clients 
        SET lastName = :lastName,
        firstName = :firstName,
        birthDate = :birthDate,
        card = :fidelityCard,
        cardNumber = NULL
        WHERE id = :id";

                $prep2 = $bdd->prepare($sql2);

                $prep2->bindParam(':lastName', $_POST['lastName']);
                $prep2->bindParam(':firstName', $_POST['firstName']);
                $prep2->bindParam(':birthDate', $_POST['birthDate']);
                $prep2->bindParam(':fidelityCard', $_POST['fidelityCard']);
                $prep2->bindParam(':id', $id);

                $id = $_POST['id'];

                $prep2->execute();
            }

            $bdd->commit();
        } catch (exception $e) {

            $bdd->rollback();
            echo "rolled back down the moooountaiiiin<br/>
    and fell into the seaaaaa it's an error you can seeee<br/>
    and i'm losing my mind.<br/>
    and this error will become longer<br/>
    until I find a solution to this mess<br/>
    Oh unbelievable distress<br/>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    update_user();
}


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
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input style="display:none" name="id" type="number" value="<?php echo (isset($_POST['id'])) ? $_POST['id'] : $id; ?>">
            <div><label for="lastName">Nom:</label>
                <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($_SESSION['modifying'][$id - 1]['lastName']); ?>">
            </div>
            <div><label for="firstName">Prénom:</label>
                <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($_SESSION['modifying'][$id - 1]['firstName']); ?>">
            </div>
            <div><label for="birthDate">Date de naissance:</label>
                <input type="date" id="birthDate" name="birthDate" value="<?php echo htmlspecialchars($_SESSION['modifying'][$id - 1]['birthDate']); ?>">
            </div>
            <div><label for="fidelityCard">Carte de fidélité:</label>
                <p><label for="oui">Oui</label>
                    <input type="radio" name="fidelityCard" id="oui" value="true" required <?php echo ($_SESSION['modifying'][$id - 1]['card'] == 1) ? 'checked' : '' ?>>
                </p>
                <p><label for="non">Non</label>
                    <input type="radio" name="fidelityCard" id="non" value="false" <?php echo ($_SESSION['modifying'][$id - 1]['card'] == 0) ? 'checked' : '' ?>>
            </div>
            </p>
            </div>

            <div><label for="cardNumber">Numéro de carte:</label>
                <input type="text" name="cardNumber" id="cardNumber" value="<?php echo htmlspecialchars($_SESSION['modifying'][$id - 1]['cardNumber']); ?>">
            </div>
            <button type="submit" name="submit" value="submit">Modifier le client</button>
        </form>
    </main>

</body>

</html>

<?php

check_logged_in();

?>