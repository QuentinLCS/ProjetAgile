<?php

$listeEleve = array();
$tableau = array(array());
function eleve($idForm){
	global $tableau;
	$tableau[0][0] = 'Form'.$idForm;
    $dbuser = 'agile8';
    $dbpass = 'ahV2FeemahM6Jiex';
    $dsn = 'mysql:host=localhost;dbname=agile8_bd;charset=utf8';

    try {
        $pdoConnection = new PDO($dsn, $dbuser, $dbpass);
        $pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur connection : ".$e->getMessage();
    }

    global $listeEleve;


    $requeteDates = "SELECT ELE_NOM, ELE_PRENOM, ELE_NUM FROM PLO_ELEVE WHERE FOR_CODE = '$idForm' ORDER BY ELE_NOM ASC";
    $res = $pdoConnection->query($requeteDates);

    /*Remplissage du tableau de date*/
    $i = 0;
    while($donnees = $res->fetch()){
        $listeEleve[$i] = $donnees['ELE_NOM'];
        $num=$donnees['ELE_NUM'];
        $i++;
    }
    statutAptitude($num);
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
    global $listeEleve;



    $requeteCompetences = "SELECT DISTINCT COM_NOM, COM_CODE, ELE_NOM, ELE_PRENOM FROM PLO_COMPETENCES JOIN PLO_ELEVE USING(FOR_CODE) WHERE ELE_NUM = '$idEleve'";
    $res = $pdoConnection->query($requeteCompetences);

    /*Premiere ligne (Competences)*/
    $i = 1;
    $j = 1;
    $tableau[1][0] = "";
    while ($donnees = $res->fetch()) {
        
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
        foreach ($listeEleve as $uneDate) {

            $tableau[$x][$j] = "X";
            $x++;

        }
    }


    for ($j=0; $j<$nombreAptitudes; $j++){

        if ($j == 0){
            $x=2;
            foreach($listeEleve as $uneDate) {

                $tableau[$x][0] = $uneDate;
                $x++;

            }
        }

        else {
            $requeteValidation = "SELECT VAL_STATUT, VAL_DATE FROM PLO_APTITUDES LEFT JOIN VALIDE USING(APT_CODE) WHERE APT_CODE = '$aptitude[$j]' AND ELE_NUM = '$idEleve' ";
            $resValidation = $pdoConnection->query($requeteValidation);

            $z = 2;
            while ($donneesValidation = $resValidation->fetch()) {

                $x=2;
                foreach($listeEleve as $uneDate) {

                    if ($donneesValidation['VAL_DATE'] == $tableau[$x][0]){
                        $tableau[$x][$j] = $donneesValidation['VAL_STATUT'];
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
    for($i=0; $i<= (count($listeEleve)+2) ;$i++){

        echo "<tr>";
        for ($j=0; $j<=(count($nombreAptitudes)+10); $j++){

            if (isset($tableau[$i][$j])) {

                if ($i==0){
                    echo '<td colspan="'.$nbCaseCompetences[$j].'" class = "center">'. $tableau[$i][$j] . '</td>';
                }
                else{
                    if($tableau[$i][$j] == "VALIDE"){
                        echo "<td class='center' style='background-color: #00C853'>" . $tableau[$i][$j] . "</td>";
                    }
                    else if($tableau[$i][$j] == "EN COUR"){
                        echo "<td class='center' style='background-color: #8d6e63'>" . $tableau[$i][$j] . "</td>";
                    }
                    else if($tableau[$i][$j] == "ABSENT"){
                        echo "<td class='center' style='background-color: #a21318'>" . $tableau[$i][$j] . "</td>";
                    }
                    else if($tableau[$i][$j] == "X"){
                        echo "<td class='center' style='background-color: #9fa8da'>" . $tableau[$i][$j] . "</td>";
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

function statut($idEleve, $idApt){

    $dbuser = 'agile8';
    $dbpass = 'ahV2FeemahM6Jiex';
    $dsn = 'mysql:host=localhost;dbname=agile8_bd;charset=utf8';

    try {
        $pdoConnection = new PDO($dsn, $dbuser, $dbpass);
        $pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur connection : " . $e->getMessage();
    }

    $requeteValidation = "SELECT VAL_STATUT, VAL_DATE FROM PLO_APTITUDES LEFT JOIN VALIDE USING(APT_CODE) WHERE APT_CODE = '$idApt' AND ELE_NUM = '$idEleve' ";
    $resValidation = $pdoConnection->query($requeteValidation);



    $total =0;
    $validite = 0;

    while ($donneesValidation = $resValidation->fetch()) {


        if ($donneesValidation['VAL_STATUT'] == "VALIDE"){
                $validite++;}
        }

        $x++;



        $z++;
    }
    $resValidation->closeCursor();

}