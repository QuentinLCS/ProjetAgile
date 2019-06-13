<?php

function heures($idEleve){

    include_once('../model/model.php');
    global $base;

    $requeteDates = "SELECT DAT_DATE FROM TRAVAILLE WHERE ELE_NUM = $idEleve";
    $_SESSION['DatesSeanceEleve'] = $base->query($requeteDates);


}
