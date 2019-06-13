<?php


$listeDates = array();
$tableau = array(array());

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
        $i++;
    }

}

function statutAptitude($idEleve){

    global $tableau;
    global $listeDates;

    include_once('../model/model.php');
    global $base;


    heures($idEleve);



    $requeteCompetences = "SELECT COM_NOM, COM_CODE FROM PLO_COMPETENCES JOIN PLO_ELEVE USING(FOR_CODE)";
    $res = $base->query($requeteCompetences);

    /*Premiere ligne (Competences)*/
    $i=0;
    $j=0;
    while($donnees = $res->fetch()){
        $tableau[0][$i] = $donnees['COM_NOM'];



        /*Seconde ligne*/
        $comCode = $donnees['COM_CODE'];
        $requeteAptitude = "SELECT APT_NOM FROM PLO_APTITUDES WHERE COM_CODE = $comCode";
        $resAptitude = $base->query($requeteAptitude);

        while($donneesLigne2 = $resAptitude->fetch()) {
            $tableau[1][$j] = $donneesLigne2['APT_NOM'];
            $j++;
        }
        $resAptitude->closeCursor();
        /*Fin ligne 2*/


        $i++;
    }
    $res->closeCursor();



    $i =2;
    foreach ($listeDates as $uneDate){
        $tableau[$i][0] = $uneDate;


    }



    /*TEST*/
    foreach ($tableau as $ligne){
        foreach ($ligne as $case){

            echo $case;

        }
        echo "<br>";
    }

}
