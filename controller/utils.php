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

elseif (isset($_POST['afficherAptitudes'])) {
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

    include_once("Menu.php");
    include_once ("../view/frontend/head.php");
    $page = "Aptitudes";

    echo ' <html lang="fr"> <head> ';
        include_once("../view/frontend/head.php");
    echo '<title>SubAlligators | '.$page.'</title></head><body><header>';
    include_once("../view/frontend/navbar.php");
    include_once("../view/frontend/login.php");
    echo '</header><main>';


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

$req = <<<HEREDOC
SELECT * FROM PLO_APTITUDES JOIN PLO_COMPETENCES USING(COM_CODE) WHERE COM_CODE = '$compCode';
HEREDOC;

$res = $pdoConnection->query($req);
$preDonnees = $res->fetch();

    echo "<h1 class='center'>".$preDonnees['COM_NOM']."</h1>";
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

    while ($donnees = $res->fetch())
    {
        echo "<tr> <td>".htmlspecialchars($donnees['APT_CODE']) . "</td><td>" .htmlspecialchars($donnees['APT_NOM']). "</td><td>" .htmlspecialchars($donnees['COM_NOM'])."</td><td>".$donnees['COM_DESC']."</td>";
        echo "<td>";
            echo '<form action="../controller/utils.php" method="post" class="usersOptions">';
                echo '<input type="text" name="num" value="<?php $donnees[\'COM_CODE\'] ?>" style="display: none;">';
                echo '<input type="submit" name="remUtilisateur" value="X" class="grey darken-4 waves-effect waves-light small">';
            echo '</form>';
        echo '</td>';
    }
    echo "</tbody> </table>";
    echo '</main><footer class="page-footer white z-depth-3">';
    include_once("../view/frontend/footer.php");
    echo '</footer></body></html>';
}