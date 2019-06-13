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

    echo 'nb date : '.$i;

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
        $requeteAptitude = "SELECT DISTINCT APT_NOM, APT_CODE FROM PLO_APTITUDES WHERE COM_CODE = '$comCode'";
        $resAptitude = $pdoConnection->query($requeteAptitude);

        while($donneesLigne2 = $resAptitude->fetch()) {
            $tableau[1][$j] = $donneesLigne2['APT_NOM']." ";
            $aptitude[$j] = $donneesLigne2['APT_CODE'];
            $j++;
        }
        $resAptitude->closeCursor();
        /*Fin ligne 2*/


        $i++;
    }
    $res->closeCursor();

    $nombreAptitudes = $j;

    echo 'Nombre aptitudes : '.$nombreAptitudes;

    $i =2;
    foreach ($listeDates as $uneDate){
        $tableau[$i][0] = $uneDate;

        for ($j=0; $j<$nombreAptitudes; $j++){

            $requeteValidation = "SELECT VAL_STATUT FROM VALIDE WHERE APT_CODE = '$aptitude[$j]' AND ELE_NUM = '$idEleve'";
            $resValidation = $pdoConnection->query($requeteValidation);

            $statut =" X ";
            while($donneesValidation = $resValidation->fetch()) {
                $statut = " ".$donneesValidation['VAL_SATUT']." ";
            }

            $tableau[$i][($j+1)] = $statut;

            $j++;
        }



        $i++;
    }


    /*TEST*/
    echo '<table>';
    foreach ($tableau as $ligne){
        echo "<tr>";
        foreach ($ligne as $case){

            echo "<td>".$case."</td>";

        }
        echo "</tr>";
    }
    echo "</table>";


}
