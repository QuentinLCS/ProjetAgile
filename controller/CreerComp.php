<?php

global $base;

include_once("../model/model.php");

$nom = $_POST['nomComp'];
$description = $_POST['description'];
$niveau = $_POST['formationComp'];
$max = 0;

$req = 'SELECT MAX(COM_CODE) FROM PLO_COMPETENCES';
$res = $base->query($req);
foreach (mysqli_fetch_array($res) as $data) {
    $max = $data;
}
$max++;

$req2 = "INSERT INTO PLO_COMPETENCES VALUES ('$max', '$niveau', '$nom', '$description')";
$base->query($req2);

header('Location: /index.php/?page=Competences');
exit();