<?php

session_start();
if(isset($_POST['numEleve'])){
    $_SESSION['numEleve'] = $_POST['numEleve'];
}


if (isset($_POST['updateInfos'])) {
    $nouveauNom = $_POST['nouveauNom'];
    $nouveauPrenom = $_POST['nouveauPrenom'];
    modifier($nouveauPrenom, $nouveauNom, $_SESSION['numEleve']);
}

elseif (isset($_POST['formulaireModifier'])) {
    include_once("../view/frontend/modifierEleve.php");
}

elseif (isset($_POST['tableauEleve'])) {
    $address = "../view/frontend/pageTableauEleve.php?id=".$_POST['numEleve'];
    header($address);
}

elseif (isset($_POST['remEleve'])) {
    supprimer($_SESSION['numEleve']);
}

elseif (isset($_POST['plusdinfos'])) {
    afficher($_SESSION['numEleve']);
}



function supprimer($numEleve){
    include_once('../model/model.php');
    global $base;
    $reqSupp = "DELETE FROM PLO_ELEVE WHERE ELE_NUM = $numEleve";
    $base->query($reqSupp);
    header('Location: ../view/frontend/visiteur.php?page=eleve');
}

function modifier($prenom, $nom, $numEleve){
    include_once('../model/model.php');
    global $base;
    $reqModif = "UPDATE PLO_ELEVE SET ELE_PRENOM = '$prenom', ELE_NOM = '$nom' WHERE ELE_NUM = $numEleve";
    $base->query($reqModif);
    header('Location: ../view/frontend/visiteur.php?page=eleve');
    echo 'SALUT';
}

function afficher($numEleve) {
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

    $req = "SELECT * FROM PLO_APTITUDES ORDER BY APT_CODE";

    $resAptitudes = $pdoConnection->query($req);

    echo '<table class="striped centered">
            <thead>
                <tr>';
                while ($donnees = $res->fetch()) {
                    echo '<th>APT?</th>';
                }
    echo '</tr>
            </thead>
            <tbody>';

    while ($donnees = $res->fetch())
    {

        echo "<tr> <td>".htmlspecialchars($donnees['FOR_NOM']) . "</td><td>" .htmlspecialchars($donnees['ELE_NOM']). "</td><td>" .htmlspecialchars($donnees['ELE_PRENOM'])."</td>"?>
        <td>
            <form action="/controller/Eleve.php" method="post" class="usersOptions">
                <input type="number" name="numEleve" value="<?php echo $num ?>" style="display: none;">
                <input type="submit" name="tableauEleve" value="TABLEAU" class="green darken-2 waves-effect waves-light small">
                <input type="submit" name="formulaireModifier" value="MODIFIER" class="red darken-2 waves-effect waves-light small">
                <input type="submit" name="remEleve" value="X" class="grey darken-4 waves-effect waves-light small">
            </form>
        </td>
        <?php
    }

    echo "</tbody> </table>";
    

    $res->closeCursor();
}