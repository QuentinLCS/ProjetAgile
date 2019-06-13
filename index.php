<?php
include_once("view/frontend/head.php");
if(isset($_COOKIE['mail']) && isset($_COOKIE['mdp'])){
        $compteur=0;
        include_once('connexionMySQL.php');

$reqsql = <<<HEREDOC
SELECT MEM_NOM, MEM_PRENOM, MEM_ROLE from PLO_MEMBRE WHERE MEM_MAIL= '$mail' AND MEM_MDP= '$mdp'
HEREDOC;
        
$reponse=$pdoConnection->prepare($reqsql);

$reponse->execute();
        
while($donnees = $reponse->fetch()){
        if($_COOKIE['mail']==$donnees['MEM_MAIL'] && $_COOKIE['mdp']==md5($donnees['MEM_MDP']) ){
            session_start();
            $compteur++;
            $_SESSION['nom']=$donnees['MEM_NOM'];
            $_SESSION['prenom']=$donnees['MEM_PRENOM'];
            $_SESSION['role']=$donnees['MEM_ROLE'];
            setcookie('mail', htmlspecialchars($_POST['mail']), time() + 24*3600, null, null, false, true);
            setcookie('mdp', md5(htmlspecialchars($_POST['mdp'])), time() + 24*3600, null, null, false, true);
        }
       
    }
    if($compteur==0){
        include_once("view/frontend/loginDepart.php");
    }
    else{
        header("Location: view/frontend/visiteur.php");
    }
    
    
}
else{
    include_once("view/frontend/loginDepart.php");
}

?>
