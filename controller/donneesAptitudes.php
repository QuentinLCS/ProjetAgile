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


    $requeteDates = "SELECT VAL_DATE FROM VALIDE WHERE ELE_NUM = '$idEleve' ORDER BY VAL_DATE ASC";
    $res = $pdoConnection->query($requeteDates);

    /*Remplissage du tableau de date*/
    $i = 0;
    while($donnees = $res->fetch()){
        $listeDates[$i] = $donnees['VAL_DATE'];
        $i++;
    }

    echo 'nb date : '.$i;

}

/**
 * @param $idEleve
 */
function statutAptitude($idEleve)
{

    echo "<br>";

    $dbuser = 'agile8';
    $dbpass = 'ahV2FeemahM6Jiex';
    $dsn = 'mysql:host=localhost;dbname=agile8_bd;charset=utf8';

    try {
        $pdoConnection = new PDO($dsn, $dbuser, $dbpass);
        $pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur connection : " . $e->getMessage();
    }

    global $tableau;
    global $listeDates;


    heures($idEleve);


    $requeteCompetences = "SELECT DISTINCT COM_NOM, COM_CODE FROM PLO_COMPETENCES JOIN PLO_ELEVE USING(FOR_CODE)";
    $res = $pdoConnection->query($requeteCompetences);


    /*Premiere ligne (Competences)*/
    $i = 0;
    $j = 1;
    $tableau[1][0] = "";
    while ($donnees = $res->fetch()) {
        $tableau[0][$i] = $donnees['COM_NOM'] . " ";


        /*Seconde ligne*/
        $comCode = $donnees['COM_CODE'];
        $requeteAptitude = "SELECT DISTINCT APT_NOM, APT_CODE FROM PLO_APTITUDES WHERE COM_CODE = '$comCode'";
        $resAptitude = $pdoConnection->query($requeteAptitude);

        while ($donneesLigne2 = $resAptitude->fetch()) {
            $tableau[1][$j] = $donneesLigne2['APT_NOM'] . " ";
            $aptitude[$j] = $donneesLigne2['APT_CODE'];
            $j++;
        }
        $resAptitude->closeCursor();
        /*Fin ligne 2*/


        $i++;
    }
    $res->closeCursor();
    $nombreAptitudes = $j;

    echo 'Nombre aptitudes : ' . $nombreAptitudes;



    for ($j=0; $j<$nombreAptitudes; $j++){

        if ($j == 0){
            $x=2;
            foreach($listeDates as $uneDate) {

                $tableau[$x][$j] = $uneDate;
                $x++;

            }
        }

        else {
            $requeteValidation = "SELECT VAL_STATUT FROM PLO_APTITUDES LEFT JOIN VALIDE USING(APT_CODE) WHERE APT_CODE = '$aptitude[$j]' AND ELE_NUM = '$idEleve' ORDER BY VAL_DATE ASC ";
            $resValidation = $pdoConnection->query($requeteValidation);

            $z = 2;
            while ($donneesValidation = $resValidation->fetch()) {


                $tableau[$z][$j] = $donneesValidation['VAL_STATUT'];


                $z++;
            }
            $resValidation->closeCursor();
        }
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
