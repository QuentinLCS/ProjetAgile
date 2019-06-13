<?php

echo "<div class='container center'>";
include_once($pageRepertory . "registerInitiateur.php");

echo "</div>";

//Connection Base de Donnee
$dbhost = 'localhost';
$dbuser = 'agile8';
$dbpass = 'ahV2FeemahM6Jiex';
$dsn = 'mysql:host=localhost;dbname=agile8_bd;charset=utf8';

try {
  $pdoConnection = new PDO($dsn, $dbuser, $dbpass);
  $pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Erreur connection : ".$e->getMessage();
}

$req = <<<HEREDOC
SELECT MEM_NUM, MEM_NOM, MEM_PRENOM, MEM_ROLE, MEM_MAIL FROM PLO_MEMBRE ORDER BY MEM_NUM asc;
HEREDOC;

$res = $pdoConnection->query($req);

    echo '<table class="striped centered">
        <thead>
            <tr>
                <th>NUMERO</th>
                <th>NOM</th>
                <th>PRENOM</th>    
                <th>FONCTION</th>  
                <th>EDITER UN MEMBRE...</th>         
            </tr>
        </thead>
        <tbody>';
session_start();
while ($donnees = $res->fetch())
{
    global $num;
    if($_SERVER['NUM']!=$donnees['MEM_NUM']){
        $num = htmlspecialchars($donnees['MEM_NUM']);
        echo "<tr> <td>".htmlspecialchars($num) . "</td><td>" .htmlspecialchars($donnees['MEM_NOM']). "</td><td>" .htmlspecialchars($donnees['MEM_PRENOM'])."</td><td>".$donnees['MEM_ROLE']."</td>"?>
        <td>
            <form action="../../controller/utils.php" method="post" class="usersOptions">
                <input type="number" name="num" value="<?php echo $num ?>" style="display: none;">
                <input type="submit" name="setDirecteur" value="DIRECTEUR" class="red darken-2 waves-effect waves-light small">
                <input type="submit" name="setResponsable" value="RESPONSABLE" class="orange darken-1 waves-effect waves-light small">
                <input type="submit" name="setInitiateur" value="INITIATEUR" class="yellow darken-2 waves-effect waves-light small">
                <input type="submit" name="remUtilisateur" value="X" class="grey darken-4 waves-effect waves-light small">
            </form>
        </td>
        }
    <?php
}

echo "</tbody> </table>";

$res->closeCursor();
?>
