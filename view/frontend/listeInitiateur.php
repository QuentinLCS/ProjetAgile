<?php
	$req = $bdd->prepare('SELECT MEM_NUM,MEM_NOM,MEM_PRENOM,MEM_MAIL FROM  ORDER BY MEM_NUM desc');
	$req->execute(array(,$_GET['MEM_NOM'],$_GET['MEM_PRENOM'],$_GET['MEM_MAIL']);
	while ($donnees = $req->fetch())
	{
		echo $donnees['MEM_NOM'].$donnees['MEM_PRENOM'].$donnees['MEM_MAIL'];
	}
	$req->closeCursor();
?>