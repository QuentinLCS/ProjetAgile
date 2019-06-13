<?php
  global $base;


    include_once ("../model/model.php");


 $code = $_POST['typeSeance'];
 $date = $_POST['dateSeance'];



//Connection Base de Donnee

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


    $req2 = "INSERT INTO PLO_SEANCE (SEA_CODE,SEA_DATE) VALUES ('$code', '$date')";
    $base->query($req2);

    header('Location: ../view/frontend/planning.php');
    exit();
?>




