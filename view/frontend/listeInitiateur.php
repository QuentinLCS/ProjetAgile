<?php
	$req = <<<HEREDOC
	SELECT MEM_NUM,MEM_NOM,MEM_PRENOM,MEM_MAIL FROM PLO_MEMBRE ORDER BY MEM_NUM desc
	HEREDOC;
	
	$res = $pdoConnection->prepare($req);
	$res->execute(array($_GET['MEM_NOM'],$_GET['MEM_PRENOM'],$_GET['MEM_MAIL']));
	while ($donnees = $req->fetch())
	{
		echo $donnees['MEM_NOM'].$donnees['MEM_PRENOM'].$donnees['MEM_MAIL'];
	}
	$req->closeCursor();
?>