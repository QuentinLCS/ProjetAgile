<?php


function modifierRole ($NumUtilisateur, $Role) {

    global $base;

    include_once('model/model.php');

    //Changer rôle

    $reqModifierRole = "UPDATE PLO_MEMBRE SET MEM_ROLE = '$Role' where MEM_NUM = '$NumUtilisateur'";
    $base->query($reqModifierRole);


}

function supprimerDonnee ($condition, $table) {

    global $base;

    include_once('model/model.php');

    $reqSupprimerLigne = "DELETE FROM '$table' WHERE '$condition'";
    $base->query($reqSupprimerLigne);
}