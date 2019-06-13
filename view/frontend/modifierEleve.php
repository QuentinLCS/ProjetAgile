<?php include_once("head.php");
global $base;

include_once ("connexionMySQL.php");
$num= $_SESSION['numEleve'];

$req = <<<HEREDOC
SELECT ELE_NOM, ELE_PRENOM from PLO_ELEVE WHERE ELE_NUM='$num';
HEREDOC;

$reponse=$pdoConnection->query($req);
      
    while($donnees = $reponse->fetch()){
        $prenom=$donnees['ELE_PRENOM'];
        $nom=$donnees['ELE_NOM'];
    }
?>
<div id="modifierEleve">
    <div class=" center">
        <h4>Modifier élève</h4>
        <div class="row">
            <h5><?php echo $prenom.' '.$nom;?></h5>
            <form class="col s12" method="post" action="/controller/Eleve.php">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="nouveauPrenom" type="text" class="validate" name="nouveauPrenom" required>
                        <label for="Prenom">Entrez Prénom</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="nouveauNom" type="text" class="validate" name="nouveauNom" required>
                        <label for="Nom">Entrez Nom</label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="updateInfos">Submit
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
    </div>
</div>