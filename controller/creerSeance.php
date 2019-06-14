<?php
global $base;

include_once('../model/model.php');

$niveauFormation = $_POST['niveauFormation'];
$date = $_POST['date'];
$heure = $_POST['heure'];

include_once("../view/frontend/connexionMySQL.php");

$req0 = <<<HEREDOC
SELECT * FROM PLO_ELEVE WHERE FOR_CODE = '$niveauFormation' ORDER BY ELE_NOM asc;
HEREDOC;

$res0 = $pdoConnection->query($req0);

while ($donnees0 = $res0->fetch()) {

    $eleveNum = $donnees0['ELE_NUM'];

    echo $eleveNum." ; ".$dateheure." ; ".$niveauFormation;

    $dateheure = $date . " " . $heure;

    $req2 = "INSERT INTO TRAVAILLE(ELE_NUM, APT_CODE, DAT_DATE) VALUES ('$eleveNum', 'PAS ENCORE PASSEE', STR_TO_DATE('$dateheure', '%Y-%m-%d %H:%i'))";
    $base->query($req2);
}
//header('Location: ../view/frontend/visiteur.php?page=planning');
//exit();
?>