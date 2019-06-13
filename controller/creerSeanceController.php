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
/*
$reponse = $bdd->query("SELECT MEM_NUM, MEM_NOM, MEM_PRENOM FROM PLO_MEMBRE");

while($donnees = $reponse->fetch())
{
	if(($membrePrenomMeet == $donnees['MEM_PRENOM']) && ($membreNomMeet == $donnees['MEM_NOM']))
	{
		$membreNumMeet = $donnees['MEM_NUM'];
	}
}
*/

$pdoConnection->exec('INSERT INTO PLO_SEANCE(SEA_CODE, SEA_DATE) VALUES (\'$nameMeet\',\'$dateMeet\')');
header('Location: /index.php');
exit();
?>