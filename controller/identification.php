<?php

if(isset($_POST['mail']) && isset($_POST['mdp'])){

	include_once('connexionMySQL.php');

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
		setcookie('mail', htmlspecialchars($_POST['mail']), time() + 24*3600, null, null, false, true);
		setcookie('mdp', md5(htmlspecialchars($_POST['mdp'])), time() + 24*3600, null, null, false, true);
	}
	if($compteur==0){
		echo "Ce compte n'existe pas";
	}

}
else{
	echo "Ce compte n'existe pas";
}
?>