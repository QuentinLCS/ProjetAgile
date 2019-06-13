<?php
global $base;
$nameMeet = htmlentities($_POST['typeSeance']);
$dateMeet = htmlentities(date('d-m-Y', strtotime($_POST['dateSeance'])));
$membreNomMeet = "H";
$membrePrenomMeet = "N";
$membreNumMeet;
//Connection Base de Donnee

$dbhost = 'localhost';
$dbuser = 'agile8';
$dbpass = 'ahV2FeemahM6Jiex';
$dsn = 'mysql:host=localhost;dbname=agile8_bd;charset=utf8';

try {
  $pdoConnection = new PDO($dsn, $dbuser, $dbpass);
  $pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Erreur connection : ".$e->getMessage();
}

$reponse = $bdd->require("SELECT MEM_NUM, MEM_NOM, MEM_PRENOM FROM PLO_MEMBRE");

while($donnees = $req->fetch())
{
	if($membrePrenomMeet == $donnees['MEM_PRENOM'] AND $membreNomMeet == $donnees['MEM_NOM'])
	{
		$membreNumMeet = $donnees['MEM_NUM'];
	}
}

include('../view/frontend/connexionMySQL.php');

$req2 = "INSERT INTO PLO_SEANCE VALUES ('$name','$membreNumMeet','$dateMeet')";
$base->query($req2);
header('Location: /index.php');
exit();
?>