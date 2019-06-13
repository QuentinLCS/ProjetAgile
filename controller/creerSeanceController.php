<?php
global $base;
$nameMeet = htmlentities($_POST['name']);
$dateMeet = htmlentities(date('d-m-Y', strtotime($_POST['dateSeance'])));
$membreNomMeet = htmlentities($_POST('nomMembre'));
$membrePrenomMeet = htmlentities($_POST('prenomMembre'));
$membreNumMeet = null;

$req = "SELECT MEM_NUM, MEM_NOM, MEM_PRENOM FROM PLO_MEMBRE";

while($donnees = $res->fetch())
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