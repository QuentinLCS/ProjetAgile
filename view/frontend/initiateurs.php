<?php

//Connection Base de Donnee
$dbhost = 'localhost';
$dbuser = 'agile8';
$dbpass = 'ahV2FeemahM6Jiex';
$dsn = 'mysql:host=localhost;dbname=agile8_bd;charset=utf8';

if(isset($_SESSION['role'])){
    if($_SESSION['role']=='DIRECTEUR' || $_SESSION['role']=='RESPONSABLE'){ 
        echo '<div class="modal-content center">';
            include_once("registerInitiateur.php");
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
SELECT MEM_NUM, MEM_NOM, MEM_PRENOM, MEM_ROLE, MEM_MAIL FROM PLO_MEMBRE ORDER BY MEM_NOM asc;
HEREDOC;

$res = $pdoConnection->query($req);

    echo '<table class="striped centered">
        <thead>
            <tr>
                <th>NOM</th>
                <th>PRENOM</th>    
                <th>FONCTION</th>
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
        $num = htmlspecialchars($donnees['MEM_NUM']);
        echo "<tr> <td>" .htmlspecialchars($donnees['MEM_NOM']). "</td><td>" .htmlspecialchars($donnees['MEM_PRENOM'])."</td><td>".$donnees['MEM_ROLE']."</td>";
        
        if(isset($_SESSION['role'])){
            if($_SESSION['role']=='DIRECTEUR' || $_SESSION['role']=='RESPONSABLE'){ ?>
               <td>
                    <form action="../../controller/utils.php" method="post" class="usersOptions">
                        <input type="number" name="num" value="<?php echo $num ?>" style="display: none;">
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
