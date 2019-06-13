<?php

session_start();
$_SESSION['numEleve'] = $_POST['numEleve'];

if (isset($_POST['updateInfos'])) {
    $nouveauNom = $_POST['nouveauNom'];
    $nouveauPrenom = $_POST['nouveauPrenom'];
    modifier($nouveauPrenom, $nouveauNom, $_SESSION['numEleve']);
    session_destroy();
}

elseif (isset($_POST['formulaireModifier'])) {
    header('localisation: .../view/frontend/visiteur.php?page=modifierEleve.php');
}

elseif (isset($_POST['remEleve'])) {
    supprimer($_SESSION['numEleve']);
    session_destroy();
}



function supprimer($numEleve){
    include_once('../model/model.php');
    global $base;
    $reqSupp = "DELETE FROM PLO_ELEVE WHERE ELE_NUM = $numEleve";
    $base->query($reqSupp);
    header('Location: ../view/frontend/visiteur.php?page=eleve');
}

function modifier($prenom, $nom, $numEleve){
    include_once('../model/model.php');
    global $base;
    $reqModif = "UPDATE PLO_ELEVE SET ELE_PRENOM = '$prenom', ELE_NOM = '$nom' WHERE ELE_NUM = $numEleve";
    $base->query($reqModif);
}