<?php 

function displaySelectTypes($fieldname){

$bdd = new DbConnect();
$bdd = $bdd->connect();

$sql = "SELECT id, type FROM showtypes";

$prep = $bdd->prepare($sql);
$prep->execute();

echo "<select name='$fieldname'>";

foreach($prep->fetchAll(PDO::FETCH_ASSOC) as $enre){

$id = $enre['id'];
$type = $enre['type'];

echo "<option value='$id' name='$fieldname'>$type</option>";

}

echo "</select>";

}

$bdd = "";


?>