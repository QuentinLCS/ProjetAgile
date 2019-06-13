<?php


$listeDates = array();

function heures($idEleve){

    global $listeDates;

    include_once('../model/model.php');
    global $base;

    $requeteDates = "SELECT DAT_DATE FROM TRAVAILLE WHERE ELE_NUM = $idEleve";
    $res = $base->query($requeteDates);

    /*Remplissage du tableau de date*/
    $i = 0;
    while($donnees = $res->fetch()){
        $listeDates[$i] = $donnees['DAT_DATE'];
    }

}

function statutAptitude($idEleve){

    global $listeDates;

    heures($idEleve);

    foreach ($listeDates as $uneDate){



    }

}
