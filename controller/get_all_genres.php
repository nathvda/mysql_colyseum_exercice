<?php 

function displaySelectGenres($fieldname){

$bdd = new DbConnect();
$bdd = $bdd->connect();

$sql = "SELECT id, genre FROM genres";

$prep = $bdd->prepare($sql);
$prep->execute();

echo "<select name='$fieldname'>";

foreach($prep->fetchAll(PDO::FETCH_ASSOC) as $enre){

$id = $enre['id'];
$genre = $enre['genre'];

echo "<option value='$id' name='$fieldname'>$genre</option>";

}

echo "</select>";

}

$bdd = "";


?>