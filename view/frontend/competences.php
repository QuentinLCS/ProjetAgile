<?php
if(isset($_SESSION['role'])){
    if($_SESSION['role']=='DIRECTEUR' || $_SESSION['role']=='RESPONSABLE'){ 
        echo "<div class='container center'>";
        include_once($pageRepertory . "formComp.php");
        include_once($pageRepertory . "formApti.php");
        echo "</div>";
    }
}


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
SELECT COM_CODE, FOR_CODE, COM_NOM, COM_DESC FROM PLO_COMPETENCES ORDER BY COM_CODE asc;
HEREDOC;

$res = $pdoConnection->query($req);

echo '<table class="striped centered">
        <thead>
            <tr>
                <th>NUMERO</th>
                <th>NIVEAU</th>
                <th>NOM</th>    
                <th>DESCRIPTION</th>  
                <th>EDITER UNE COMPETENCE...</th>         
            </tr>
        </thead>
        <tbody>';

while ($donnees = $res->fetch())
{
    global $num;
    $num = htmlspecialchars($donnees['COM_CODE']);

    echo "<tr> <td>".htmlspecialchars($num) . "</td><td>" .htmlspecialchars($donnees['FOR_CODE']). "</td><td>" .htmlspecialchars($donnees['COM_NOM'])."</td><td>".$donnees['COM_DESC']."</td>"?>
    <td>
        <form action="../../controller/utils.php" method="post" class="usersOptions">
            <input type="submit" name="remUtilisateur" value="X" class="grey darken-4 waves-effect waves-light small">
        </form>
    </td>
    <?php
}

echo "</tbody> </table>";

$res->closeCursor();
?>
