<?php


$numEleve = $_POST['numEleve'];


if (isset($_POST['updateInfos'])) {
    $nouveauNom = $_POST['Nom'];
    $nouveauPrenom = $_POST['Prenom'];
    modifier($nouveauPrenom, $nouveauNom, $numEleve);
}

elseif (isset($_POST['remEleve'])) {
    supprimer($numEleve);
}



function supprimer($numEleve){
    include_once("model/model.php");
    global $base;
    $reqSupp = "DELETE FROM PLO_ELEVE WHERE ELE_NUM = $numEleve";
    $base->query($reqSupp);
}

function modifier($prenom, $nom, $numEleve){
    include_once("model/model.php");
    global $base;
    $reqModif = "UPDATE PLO_ELEVE SET ELE_PRENOM = '$prenom', ELE_NOM = '$nom' WHERE ELE_NUM = $numEleve";
    $base->query($reqModif);
}