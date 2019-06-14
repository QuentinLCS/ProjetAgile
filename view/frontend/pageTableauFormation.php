<?php

include_once("head.php");

//?id=2;
//if (isset($_GET['id'])){

    $idForm = '1';

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

    /*$reqCheck = "SELECT ELE_NUM FROM PLO_ELEVE WHERE ELE_NUM = '$idEleve'";
    $res = $pdoConnection->query($reqCheck);

    if ($res->fetch()){*/

        include_once("../../controller/donneesFormation.php");

        eleve($idForm);

    /*}
    else{
        echo "Mauvais id eleve";
    }*/

    //$res->closeCursor();

//}
