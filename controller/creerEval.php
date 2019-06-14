<?php
global $base;

include_once('../model/model.php');

$eleveNum = $_POST['eleve'];
$aptitude = $_POST['aptitude'];
$date = $_POST['seance'];
$commentaire = $_POST['commentaire'];

$req = "UPDATE TRAVAILLE SET APT_CODE = '$aptitude', EVA_COMMENTAIRE = '$commentaire'";
$base->query($req);

if (isset($_POST['estValide'])) {
    $req3 = "INSERT INTO VALIDE(ELE_NUM, APT_CODE, VAL_DATE, VAL_STATUT) VALUES ('$eleveNum', '$aptitude', '$date', 'VALIDE')";
    $base->query($req3);
} else {
    $req3 = "INSERT INTO VALIDE(ELE_NUM, APT_CODE, VAL_DATE, VAL_STATUT) VALUES ('$eleveNum', '$aptitude', '$date', 'EN COURS')";
    $base->query($req3);
}

header('Location: ../view/frontend/visiteur.php?page=planning');
exit();
?>