<?php

if(isset($_POST['mail']) && isset($_POST['mdp'])){
	$compteur=0;
	$dbhost = 'localhost';
	$dbuser = 'agile8';
	$dbpass = 'ahV2FeemahM6Jiex';
	$dsn = 'mysql:host=localhost;dbname=agile8_bd;charset=utf8';
	$mail=$_POST['mail'];
	$mdp=md5($_POST['mdp']);

try {
	$pdoConnection = new PDO($dsn, $dbuser, $dbpass);
	$pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Erreur connection : ".$e->getMessage();
}

$reqsql = <<<HEREDOC
SELECT MEM_NOM, MEM_PRENOM, MEM_ROLE from PLO_MEMBRE WHERE MEM_MAIL= '$mail' AND MEM_MDP= '$mdp'
HEREDOC;
		
$reponse=$pdoConnection->prepare($reqsql);

$reponse->execute();
		
	while($donnees = $reponse->fetch()){
		$compteur++;
		session_start();
		$_SESSION['nom']=$donnees['MEM_NOM'];
		$_SESSION['prenom']=$donnees['MEM_PRENOM'];
		$_SESSION['role']=$donnees['MEM_ROLE'];
		echo 'Bonjour '. $_SESSION['prenom']. ' '. $_SESSION['nom'];
	}
	if($compteur==0){
		echo "Ce compte n'existe pas";
	}

}
else{
	echo "Ce compte n'existe pas";
}
?>