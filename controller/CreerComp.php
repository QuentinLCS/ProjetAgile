<?php

global $base;

include_once("../model/model.php");

$numEleve=$_SESSION['num'];
$num = "SELECT MEM_NIVEAU_FORM FROM PLO_MEMBRE where ELE_NUM='$numEleve' "
$resultat = $base->query($num);
$niveau = $resultat->fetch();

$nom = $_POST['nomComp'];
$description = $_POST['description'];
$comCode = "F".$niveau."C";

$req = 'SELECT COUNT(*) FROM PLO_COMPETENCES';
$res = $base->query($req);
foreach (mysqli_fetch_array($res) as $data) {
    $max = $data;
}
$max++;

$comCode = $comCode.$max;

$req2 = "INSERT INTO PLO_COMPETENCES(COM_CODE, FOR_CODE, COM_NOM, COM_DESC) VALUES ('$comCode', '$niveau', '$nom', '$description')";
$base->query($req2);

header('Location: ../view/frontend/visiteur.php?page=Competences');
exit();