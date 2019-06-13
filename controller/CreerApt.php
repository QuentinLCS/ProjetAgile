<?php

global $base;

include_once("../model/model.php");

$nom = $_POST['nomApti'];
$description = $_POST['descriptionApti'];
$compCode = $_POST['compApti'];
$aptCode = $compCode."F";

$req = 'SELECT COUNT(*) FROM PLO_APTITUDES';
$res = $base->query($req);
foreach (mysqli_fetch_array($res) as $data) {
    $max = $data;
}
$max++;

$req2 = "INSERT INTO PLO_APTITUDES VALUES ('$aptCode.$max', '$compCode', '$nom', '$description')";
$base->query($req2);

header('Location: ../view/frontend/visiteur.php?page=Competences');
exit();