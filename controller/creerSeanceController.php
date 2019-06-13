<?php
global $base;
$nameMeet = htmlentities($_POST['typeSeance']);
$dateMeet = htmlentities(date('d-m-Y', strtotime($_POST['dateSeance'])));
$membreNomMeet = "H";
$membrePrenomMeet = "N";
$membreNumMeet = null;

$reponse = $bdd->query("SELECT MEM_NUM, MEM_NOM, MEM_PRENOM FROM PLO_MEMBRE");

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