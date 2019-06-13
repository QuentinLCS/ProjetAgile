<?php
global $base;
$nameMeet = htmlentities($_POST['name']);
$dateMeet = htmlentities(date('d-m-Y', strtotime($_POST['dateSeance'])));
$membreMeet = htmlentities($_POST('selectMembre'));
$membreNumMeet = htmlentities($_POST('numMembre'));
include_once('../view/frontend/connexionMySQL.php');

$req = "INSERT INTO PLO_SEANCE VALUES ('$name','$membreNumMeet','$dateMeet')";
$base->query($req);
header('Location: /index.php')
exit();
?>