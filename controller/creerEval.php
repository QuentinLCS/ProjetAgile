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
    if ($_POST['estValide'] == 1) {
        $req3 = "INSERT INTO VALIDE(ELE_NUM, APT_CODE, VAL_DATE, VAL_STATUT) VALUES ('$eleveNum', '$aptitude', '$date', 'VALIDE')";
    } elseif ($_POST['estValide'] == 2) {
        $req3 = "INSERT INTO VALIDE(ELE_NUM, APT_CODE, VAL_DATE, VAL_STATUT) VALUES ('$eleveNum', '$aptitude', '$date', 'NON VALIDE')";
    } elseif ($_POST['estValide'] == 3) {
        $req3 = "INSERT INTO VALIDE(ELE_NUM, APT_CODE, VAL_DATE, VAL_STATUT) VALUES ('$eleveNum', '$aptitude', '$date', 'EN COURS')";
    } else {
        $req3 = "INSERT INTO VALIDE(ELE_NUM, APT_CODE, VAL_DATE, VAL_STATUT) VALUES ('$eleveNum', '$aptitude', '$date', 'ABSENT')";
        $base->query($req3);
    }
    $base->query($req3);
}

header('Location: ../view/frontend/visiteur.php?page=planning');
exit();
?>