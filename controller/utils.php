<?php

$num = $_POST['num'];

if (isset($_POST['setDirecteur'])) {
    modifierRole($num , "DIRECTEUR");
}
elseif (isset($_POST['setResponsable'])) {
    modifierRole($num , "RESPONSABLE");
}

elseif (isset($_POST['setInitiateur'])) {
    modifierRole($num , "INITIATEUR");
}

elseif (isset($_POST['remUtilisateur'])) {
    supprimerDonnee("MEM_NUM = $num","PLO_MEMBRE");
}

elseif (isset($_POST['compCode'])) {
    afficherAptitudes($num);
}


function modifierRole ($NumUtilisateur, $Role) {

    global $base;

    include_once('../model/model.php');

    //Changer rôle

    $reqModifierRole = "UPDATE PLO_MEMBRE SET MEM_ROLE = '$Role' where MEM_NUM = '$NumUtilisateur'";
    $base->query($reqModifierRole);

    header('Location: /view/frontend/visiteur.php?page=Initiateurs');
    exit();
}

function supprimerDonnee ($condition, $table) {

    global $base;

    include_once('../model/model.php');

    $reqSupprimerLigne = "DELETE FROM $table WHERE $condition";
    $base->query($reqSupprimerLigne);

    header('Location: ../view/frontend/visiteur.php?page=Initiateurs');
    exit();
}

function afficherAptitudes($compCode) {

$dbhost = 'localhost';
$dbuser = 'agile8';
$dbpass = 'ahV2FeemahM6Jiex';
$dsn = 'mysql:host=localhost;dbname=agile8_bd;charset=utf8';

include_once("registerInitiateur.php");
try {
    $pdoConnection = new PDO($dsn, $dbuser, $dbpass);
    $pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur connection : ".$e->getMessage();
}

    echo "cc";

$req = <<<HEREDOC
SELECT * FROM PLO_APTITUDES JOIN PLO_COMPETENCES USING(COM_CODE) WHERE COM_CODE = $compCode;
HEREDOC;

echo "cc";

$res = $pdoConnection->query($req);

echo '<table class="striped centered">
        <thead>
            <tr>
                <th>NUMERO</th>
                <th>NOM</th>
                <th>DESCRIPTION</th>  
                <th>EDITER UNE APTITUDE...</th>         
            </tr>
        </thead>
        <tbody>';
    while ($donnees = $res->fetch()) {

$num = htmlspecialchars($donnees['APT_CODE']);

echo "<tr> <td>".htmlspecialchars($num) . "</td><td>" .htmlspecialchars($donnees['APT_NOM']). '</td><td>' .htmlspecialchars($donnees['APT_DESC']).'</td>'?>
        <td>
            <form action="utils.php" method="post" class="usersOptions">
                <input type="text" name="aptcode" value="<?php $donnees['APT_CODE'] ?>" style="display: none;">
                <input type="submit" name="remUtilisateur" value="X" class="grey darken-4 waves-effect waves-light small">
            </form>
        </td>;
<?php 
    }
}