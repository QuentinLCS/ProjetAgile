<?php

global $base;

    include_once('../model/model.php');


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
session_start();
$numEleve=$_SESSION['num'];
$num = "SELECT MEM_NIVEAU_FORM FROM PLO_MEMBRE where MEM_NUM='$numEleve'";
$resultat = $pdoConnection->query($num);
$niveau = $resultat->fetch();
$niveauMembre=$niveau['MEM_NIVEAU_FORM'];

$nom = $_POST['nomComp'];
$description = $_POST['description'];
$comCode = "F".$niveauMembre."C";

$req = 'SELECT COUNT(*) FROM PLO_COMPETENCES';
$res = $base->query($req);
foreach (mysqli_fetch_array($res) as $data) {
    $max = $data;
}
$max++;

$comCode = $comCode.$max;

$req2 = "INSERT INTO PLO_COMPETENCES(COM_CODE, FOR_CODE, COM_NOM, COM_DESC) VALUES ('$comCode', '$niveauMembre', '$nom', '$description')";
$base->query($req2);

header('Location: ../view/frontend/visiteur.php?page=Competences');
exit();