<?php

global $base;

include_once("../model/model.php");

$nom = $_POST['nomApti'];
$description = $_POST['descriptionApti'];
$compCode = $_POST['competence'];
$aptCode = $compCode;

$req = 'SELECT COUNT(*) FROM PLO_APTITUDES JOIN PLO_COMPETENCES USING(COM_CODE)';
$res = $base->query($req);
foreach (mysqli_fetch_array($res) as $data) {
    $max = $data;
}
$max++;

$aptCode = "A".$max.$aptCode;



$req2 = "INSERT INTO PLO_APTITUDES(APT_CODE, COM_CODE, APT_NOM, APT_DESC) VALUES ('$aptCode', '$compCode', '$nom', '$description')";
$base->query($req2);

header('Location: ../view/frontend/visiteur.php?page=Competences');
//exit();?>