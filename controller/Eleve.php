<?php

include_once("model/model.php");

class Eleve
{
    private $numEleve;

    public function __construct($idEleve){
        $this->numEleve = $idEleve;
    }

    public function supprimer()
    {
        global $base;
        $reqSupp1 = "DELETE FROM PLO_ELEVE WHERE ELE_NUM = $this->numEleve";
        $base->query($reqSupp1);
    }

    public function modifier($prenom, $nom){
        global $base;
        $reqModif = "UPDATE PLO_ELEVE SET ELE_PRENOM = '$prenom', ELE_NOM = '$nom' WHERE ELE_NUM = $this->numEleve";
        $base->query($reqSupp1);
    }


}