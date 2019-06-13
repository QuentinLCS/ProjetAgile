<?php


$listeDates = array();
$tableau = array(array());

function heures($idEleve){

    $dbuser = 'agile8';
    $dbpass = 'ahV2FeemahM6Jiex';
    $dsn = 'mysql:host=localhost;dbname=agile8_bd;charset=utf8';

    try {
        $pdoConnection = new PDO($dsn, $dbuser, $dbpass);
        $pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur connection : ".$e->getMessage();
    }

    global $listeDates;


    $requeteDates = "SELECT DAT_DATE FROM TRAVAILLE WHERE ELE_NUM = '$idEleve' ORDER BY DAT_DATE ASC";
    $res = $pdoConnection->query($requeteDates);

    /*Remplissage du tableau de date*/
    $i = 0;
    while($donnees = $res->fetch()){
        $listeDates[$i] = $donnees['DAT_DATE'];
        $i++;
    }

}

function statutAptitude($idEleve){

    echo "<br>";

    $dbuser = 'agile8';
    $dbpass = 'ahV2FeemahM6Jiex';
    $dsn = 'mysql:host=localhost;dbname=agile8_bd;charset=utf8';

    try {
        $pdoConnection = new PDO($dsn, $dbuser, $dbpass);
        $pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur connection : ".$e->getMessage();
    }

    global $tableau;
    global $listeDates;



    heures($idEleve);



    $requeteCompetences = "SELECT DISTINCT COM_NOM, COM_CODE FROM PLO_COMPETENCES JOIN PLO_ELEVE USING(FOR_CODE)";
    $res = $pdoConnection->query($requeteCompetences);


    /*Premiere ligne (Competences)*/
    $i=0;
    $j=0;
    while($donnees = $res->fetch()){
        $tableau[0][$i] = $donnees['COM_NOM']." ";



        /*Seconde ligne*/
        $comCode = $donnees['COM_CODE'];
        $requeteAptitude = "SELECT DISTINCT APT_NOM FROM PLO_APTITUDES WHERE COM_CODE = '$comCode'";
        $resAptitude = $pdoConnection->query($requeteAptitude);

        while($donneesLigne2 = $resAptitude->fetch()) {
            $tableau[1][$j] = $donneesLigne2['APT_NOM']." ";
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
        $i++;
    }



    /*TEST*/
    foreach ($tableau as $ligne){
        foreach ($ligne as $case){

            echo $case;

        }
        echo "<br>";
    }



}
