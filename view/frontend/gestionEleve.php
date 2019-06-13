<?php


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

$req = "SELECT ELE_NUM, ELE_NOM,ELE_PRENOM FROM PLO_ELEVE ORDER BY ELE_NUM asc";

$res = $pdoConnection->query($req);

echo '<table class="striped centered">
        <thead>
            <tr>
                <th>NUMERO</th>
                <th>NOM</th>
                <th>PRENOM</th>     
                <th>EDITER UN ELEVE...</th>         
            </tr>
        </thead>
        <tbody>';

while ($donnees = $res->fetch())
{
    global $num;
    $num = htmlspecialchars($donnees['ELE_NUM']);

    echo "<tr> <td>".htmlspecialchars($num) . "</td><td>" .htmlspecialchars($donnees['ELE_NOM']). "</td><td>" .htmlspecialchars($donnees['ELE_PRENOM'])."</td>"?>
    <td>
        <form action="../../controller/Eleve.php" method="post" class="usersOptions">
            <input type="number" name="numEleve" value="<?php echo $num ?>" style="display: none;">
            <input type="submit" name="formulaireModifier" value="MODIFIER" class="red darken-2 waves-effect waves-light small">
            <input type="submit" name="remEleve" value="X" class="grey darken-4 waves-effect waves-light small">
        </form>
    </td>
    <?php
}

echo "</tbody> </table>";

$res->closeCursor();
?>
