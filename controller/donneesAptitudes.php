<?php


$listeDates = array();
$tableau = array(array());
$validiteComp = array();

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


    $requeteDates = "SELECT DISTINCT VAL_DATE FROM VALIDE WHERE ELE_NUM = '$idEleve' ORDER BY VAL_DATE ASC";
    $res = $pdoConnection->query($requeteDates);

    /*Remplissage du tableau de date*/
    $i = 0;
    while($donnees = $res->fetch()){
        $listeDates[$i] = $donnees['VAL_DATE'];
        $i++;
    }



}


function statutAptitude($idEleve)
{

    $nbCaseCompetences = array();
    $nbCaseCompetences[0] = 1;

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
    global $validiteComp;


    heures($idEleve);


    $requeteCompetences = "SELECT DISTINCT COM_NOM, COM_CODE, ELE_NOM, ELE_PRENOM FROM PLO_COMPETENCES JOIN PLO_ELEVE USING(FOR_CODE) WHERE ELE_NUM = '$idEleve'";
    $res = $pdoConnection->query($requeteCompetences);

    /*Premiere ligne (Competences)*/
    $i = 1;
    $j = 1;
    $tableau[1][0] = "";
    while ($donnees = $res->fetch()) {
        $tableau[0][0] = $donnees['ELE_PRENOM'].' '.$donnees['ELE_NOM'];
        $tableau[0][$i] = $donnees['COM_NOM'];


        /*Seconde ligne*/
        $comCode = $donnees['COM_CODE'];
        $requeteAptitude = "SELECT DISTINCT APT_NOM, APT_CODE FROM PLO_APTITUDES WHERE COM_CODE = '$comCode'";
        $resAptitude = $pdoConnection->query($requeteAptitude);

        $nbAptComp = 0;
        while ($donneesLigne2 = $resAptitude->fetch()) {
            $nbAptComp ++;
            $tableau[1][$j] = $donneesLigne2['APT_NOM'];
            $aptitude[$j] = $donneesLigne2['APT_CODE'];
            $j++;
        }
        $nbCaseCompetences[$i] = $nbAptComp;
        $resAptitude->closeCursor();
        /*Fin ligne 2*/


        $i++;
    }
    $res->closeCursor();
    $nombreAptitudes = $j;



    for ($j=1; $j<$nombreAptitudes; $j++) {
        $x=2;
        foreach ($listeDates as $uneDate) {

            $tableau[$x][$j] = "X";
            $x++;

        }
    }


    for ($j=0; $j<$nombreAptitudes; $j++){

        if ($j == 0){
            $x=2;
            foreach($listeDates as $uneDate) {

                $tableau[$x][0] = $uneDate;
                $x++;

            }
        }

        else {
            $requeteValidation = "SELECT VAL_STATUT, VAL_DATE FROM PLO_APTITUDES LEFT JOIN VALIDE USING(APT_CODE) WHERE APT_CODE = '$aptitude[$j]' AND ELE_NUM = '$idEleve' ";
            $requeteCommentaire = "SELECT EVA_COMMENTAIRE FROM TRAVAILLE JOIN VALIDE ON TRAVAILLE.ELE_NUM = VALIDE.ELE_NUM AND TRAVAILLE.APT_CODE = VALIDE.APT_CODE AND TRAVAILLE.DAT_DATE = VALIDE.VAL_DATE WHERE VALIDE.APT_CODE ='$aptitude[$j]' AND VALIDE.ELE_NUM='$idEleve'";
            $resValidation = $pdoConnection->query($requeteValidation);

            $z = 2;
            while ($donneesValidation = $resValidation->fetch()) {

                $x=2;
                $validiteComp[$j] = 0;
                foreach($listeDates as $uneDate) {

                    if ($donneesValidation['VAL_DATE'] == $tableau[$x][0]){
                        $tableau[$x][$j] = $donneesValidation['VAL_STATUT'];

                        if ($donneesValidation['VAL_STATUT'] == "VALIDE"){
                            $validiteComp[$j]++;
                        }

                    }
                    $x++;
                }
                $z++;
            }
            $resValidation->closeCursor();

            $resValidation = $pdoConnection->query($requeteCommentaire);
            $z = 2;
            while ($donneesValidation = $resValidation->fetch()) {

                $x=2;
                $validiteComp[$j] = 0;
                foreach($listeDates as $uneDate) {

                    if ($donneesValidation['VAL_DATE'] == $tableau[$x][0]){
                        $commentaire[$x][$j] = $donneesValidation['VAL_STATUT'];
                    }
                    $x++;
                }
                $z++;
            }
            $resValidation->closeCursor();
        }
    }


    /*TEST*/
    echo '<table>';
    for($i=0; $i<= (count($listeDates)+2) ;$i++){

        echo "<tr>";
        for ($j=0; $j<=(count($nombreAptitudes)+15); $j++){

            $description = " pas de com ";
            if (isset($commentaire[$i][$j])){
                $description = $commentaire[$i][$j];
            }

            if (isset($tableau[$i][$j])) {


                if ($i==0){
                    echo '<td colspan="'.$nbCaseCompetences[$j].'" class = "center">'. $tableau[$i][$j] . '</td>';
                }
                else{
                    if($tableau[$i][$j] == "VALIDE"){
                        echo "<td title = '".$description."' class='center' style='background-color: #00C853'>" . $tableau[$i][$j] . "</td>";
                    }
                    else if($tableau[$i][$j] == "EN COUR"){
                        echo "<td title = '".$description."' class='center' style='background-color: #8d6e63'>" . $tableau[$i][$j] . "</td>";
                    }
                    else if($tableau[$i][$j] == "ABSENT"){
                        echo "<td title = '".$description."' class='center' style='background-color: #a21318'>" . $tableau[$i][$j] . "</td>";
                    }
                    else if($tableau[$i][$j] == "X"){
                        echo "<td title = '".$description."' class='center' style='background-color: #9fa8da'>" . $tableau[$i][$j] . "</td>";
                    }
                    else{
                        echo "<td class='center'>" . $tableau[$i][$j] . "</td>";
                    }

                }
            }
        }
        echo "</tr>";
    }
    echo "</table>";


}
