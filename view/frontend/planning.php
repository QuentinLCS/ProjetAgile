<?php

//Connection Base de Donnee
$dbhost = 'localhost';
$dbuser = 'agile8';
$dbpass = 'ahV2FeemahM6Jiex';
$dsn = 'mysql:host=localhost;dbname=agile8_bd;charset=utf8';

if(isset($_SESSION['role'])){
    if($_SESSION['role']=='DIRECTEUR' || $_SESSION['role']=='RESPONSABLE'){ 
        echo '<div class="modal-content center">';
            include_once("formSeance.php");
        echo '</div>';
    }
}

    
try {
  $pdoConnection = new PDO($dsn, $dbuser, $dbpass);
  $pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Erreur connection : ".$e->getMessage();
}

$req = <<<HEREDOC
SELECT * FROM TRAVAILLE JOIN PLO_ELEVE USING (ELE_NUM) JOIN PLO_APTITUDES USING(APT_CODE) ORDER BY DAT_DATE asc;
HEREDOC;

$res = $pdoConnection->query($req);

    echo '<table class="striped centered">
        <thead>
            <tr>
                <th>DATE</th>
                <th>ELEVE</th>
                <th>APTITUDE</th>    
                <th>COMMENTAIRE</th>
                ';
    if(isset($_SESSION['role'])){
        if($_SESSION['role']=='DIRECTEUR' || $_SESSION['role']=='RESPONSABLE'){  
            echo'<th>EDITER UN MEMBRE...</th>';
        }
    }
    echo '</tr>
        </thead>
        <tbody>';
while ($donnees = $res->fetch())
{
        echo "<tr> <td>".htmlspecialchars($donnees['DAT_DATE']) . "</td><td>" .htmlspecialchars($donnees['ELE_NOM'])." ".htmlspecialchars($donnees['ELE_PRENOM']). "</td><td>" .htmlspecialchars($donnees['APT_NOM'])."</td><td>".$donnees['EVA_COMMENTAIRE']."</td>";
        
        if(isset($_SESSION['role'])){
            if($_SESSION['role']=='DIRECTEUR' || $_SESSION['role']=='RESPONSABLE'){ ?>
               <td>
                    <form action="../../controller/utils.php" method="post" class="usersOptions">
                        <input type="submit" name="setDirecteur" value="DIRECTEUR" class="red darken-2 waves-effect waves-light small">
                        <input type="submit" name="setResponsable" value="RESPONSABLE" class="orange darken-1 waves-effect waves-light small">
                        <input type="submit" name="setInitiateur" value="INITIATEUR" class="yellow darken-2 waves-effect waves-light small">
                        <input type="submit" name="remUtilisateur" value="X" class="grey darken-4 waves-effect waves-light small">
                    </form>
                </td>
                <?php
            }
        }
        
    
}

echo "</tbody> </table>";

$res->closeCursor();
?>