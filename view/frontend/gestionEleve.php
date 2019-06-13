<?php

include_once("model/model.php");

//Connection Base de Donnee
global $base;

$req = "SELECT ELE_NUM, ELE_NOM,ELE_PRENOM FROM PLO_ELEVE ORDER BY ELE_NUM asc";

$res = $base->query($req);

echo '<table class="striped centered">
        <thead>
            <tr>
                <th>NUMERO</th>
                <th>NOM</th>
                <th>PRENOM</th>    
                <th> </th>  
                <th>EDITER UN ELEVE...</th>         
            </tr>
        </thead>
        <tbody>';

while ($donnees = $res->fetch())
{
    global $num;
    $num = htmlspecialchars($donnees['ELE_NUM']);

    echo "<tr> <td>".htmlspecialchars($num) . "</td><td>" .htmlspecialchars($donnees['ELE_NOM']). "</td><td>" .htmlspecialchars($donnees['MEM_PRENOM'])."</td><td>".$donnees['MEM_ROLE']."</td>"?>
    <td>
        <form action="../../controller/Eleve.php" method="post" class="usersOptions">
            <input type="number" name="numEleve" value="<?php echo $num ?>" style="display: none;">
            <input type="submit" name="updateInfos" value="MODIFIER" class="red darken-2 waves-effect waves-light small">
            <input type="submit" name="remEleve" value="X" class="grey darken-4 waves-effect waves-light small">
        </form>
    </td>
    <?php
}

echo "</tbody> </table>";

$res->closeCursor();
?>
