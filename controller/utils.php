<?php

if (isset($_POST['num']))
    $num = $_POST['num'];
if (isset($_POST['numEleve'])) {

    $numEleve = $_POST['numEleve'];
    $date = $_POST['date'];
    $aptitude = $_POST['aptitude'];
}


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

elseif (isset($_POST['remCompetences'])) {
    supprimerDonnee("COM_CODE = '$num'","PLO_COMPETENCES");
}

elseif (isset($_POST['remSeance'])) {
    supprimerDonnee("ELE_NUM = $numEleve AND DAT_DATE = '$date' AND APT_CODE = '$aptitude'","TRAVAILLE");
}

elseif (isset($_POST['remAptitudes'])) {
    supprimerDonnee("APT_CODE = '$num'","PLO_APTITUDES");
}

elseif (isset($_POST['afficherAptitudes'])) {
    afficherAptitudes($num);
}


function modifierRole ($NumUtilisateur, $Role) {

    global $base;

    include_once('../model/model.php');

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

    if ($table == "PLO_MEMBRE")
        header('Location: ../view/frontend/visiteur.php?page=Initiateurs');
    elseif ($table == "PLO_COMPETENCES" || $table == "PLO_APTITUDES")
        header('Location: ../view/frontend/visiteur.php?page=Competences');
    else
        header('Location: ../view/frontend/visiteur.php?page=Planning');
    exit();

}

function afficherAptitudes($compCode) {
    session_start();
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
$req2 = <<<HEREDOC
SELECT * FROM PLO_COMPETENCES WHERE COM_CODE = '$compCode';
HEREDOC;

$res = $pdoConnection->query($req);
$res2=  $pdoConnection->query($req2);

$preDonnees = $res2->fetch();

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
        echo "<tr> <td>".htmlspecialchars($donnees['APT_CODE']) . "</td><td>" .htmlspecialchars($donnees['APT_NOM']). "</td><td>".$donnees['APT_DESC']."</td>";
        echo "<td>";
            echo '<form action="../controller/utils.php" method="post" class="usersOptions">';
                echo '<input type="text" name="num" value="';
                echo $donnees["APT_CODE"];
                echo '" style="display: none;">';
                echo '<input type="submit" name="remAptitudes" value="X" class="grey darken-4 waves-effect waves-light small">';
            echo '</form>';
        echo '</td>';
    }
    echo "</tbody> </table>";
    echo '</main><footer class="page-footer white z-depth-3">';
    include_once("../view/frontend/footer.php");
    echo '</footer></body></html>';
}