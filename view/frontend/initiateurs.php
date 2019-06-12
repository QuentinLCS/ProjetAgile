<?php
//Connection Base de Donnee
include_once "controller/Utils.php";
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
SELECT MEM_NUM, MEM_ROLE,MEM_NOM,MEM_PRENOM,MEM_MAIL FROM PLO_MEMBRE ORDER BY MEM_NUM asc;
HEREDOC;

$res = $pdoConnection->query($req);

    echo '<table class="striped highlight centered">
        <thead>
            <tr>
                <th>NUMERO</th>
                <th>NOM</th>
                <th>PRENOM</th>    
                <th>FONCTION</th>  
                <th>EDITER LA FONCTION DU MEMBRE...</th>         
            </tr>
        </thead>
        <tbody>';

while ($donnees = $res->fetch())
{
    echo "<tr> <td>".htmlspecialchars($donnees['MEM_NUM']) . "</td><td>" .htmlspecialchars($donnees['MEM_NOM']). "</td><td>" .htmlspecialchars($donnees['MEM_PRENOM'])."</td><td>".$donnees['MEM_ROLE']."</td>"?>
    <td>
        <a class="waves-effect waves-light btn small" onclick="Utils::modifierRole($donnees['MEM_NUM'], 'DIRECTEUR');">Directeur</a>
        <a class="waves-effect waves-light btn" onclick="Utils::modifierRole($donnees['MEM_NUM'], 'RESPONSABLE');">Responsable</a>
        <a class="waves-effect waves-light btn" onclick="Utils::modifierRole($donnees['MEM_NUM'], 'INITIATEUR');">Initiateur</a>
    </td>
    <?php
}

echo "</tbody> </table>";

$res->closeCursor();


include_once($pageRepertory . "registerInitiateur.php");
include_once($pageRepertory . "registerEleve.php");
?>
