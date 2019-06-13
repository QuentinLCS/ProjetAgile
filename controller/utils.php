<?php

$num = $_POST['num'];

if (isset($_POST['setDirecteur'])) {
    modifierRole($num , "DIRECTEUR");
}
elseif (isset($_POST['setResponsable'])) {
    modifierRole($num , "RESPONSABLE");
}

elseif (isset($_POST['setInitiateur'])) {
    modifierRole($num , "INITIATEUR");
}

elseif (isset($_POST['remUtilisateur'])) {
    supprimerDonnee("MEM_NUM = $num","PLO_MEMBRE");
}


function modifierRole ($NumUtilisateur, $Role) {

    global $base;

    include_once('../model/model.php');

    //Changer rôle

    $reqModifierRole = "UPDATE PLO_MEMBRE SET MEM_ROLE = '$Role' where MEM_NUM = '$NumUtilisateur'";
    $base->query($reqModifierRole);

    header('Location: ../view/frontend/visiteur.php?page=Initiateurs');
    
}

function supprimerDonnee ($condition, $table) {

    global $base;

    include_once('../model/model.php');

    $reqSupprimerLigne = "DELETE FROM $table WHERE $condition";
    $base->query($reqSupprimerLigne);

    header('Location: ../view/frontend/visiteur.php?page=Initiateurs');
    exit();
}