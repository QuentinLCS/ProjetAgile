<?php
global $base;

include_once('../model/model.php');

$eleveNum = $_POST['eleve'];
$aptitude = $_POST['aptitude'];
$date = $_POST['date'];
$heure = $_POST['heure'];
$commentaire = $_POST['commentaire'];

$req = 'SELECT MAX(MEM_NUM) FROM PLO_MEMBRE';
$res = $base->query($req);

$dateheure = $date." ".$heure;

$req2 = "INSERT INTO TRAVAILLE(ELE_NUM, APT_CODE, DAT_DATE, EVA_COMMENTAIRE) VALUES ('$eleveNum', '$aptitude', STR_TO_DATE('$dateheure', '%Y-%m-%d %H:%i'), '$commentaire')";
$base->query($req2);


if (isset($_POST['estValide'])) {

    $req3 = "INSERT INTO VALIDE(ELE_NUM, APT_CODE, VAL_DATE, VAL_STATUT) VALUES ('$eleveNum', '$aptitude', STR_TO_DATE('$dateheure', '%Y-%m-%d %H:%i'), 'VALIDE')";
    $base->query($req3);
}
else{
	$req3 = "INSERT INTO VALIDE(ELE_NUM, APT_CODE, VAL_DATE, VAL_STATUT) VALUES ('$eleveNum', '$aptitude', STR_TO_DATE('$dateheure', '%Y-%m-%d %H:%i'), 'EN COURS')";
    $base->query($req3);
}

header('Location: ../view/frontend/visiteur.php?page=planning');
exit();
?>