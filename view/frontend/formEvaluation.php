<?php

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

?>

<a class="grey darken-3 waves-effect waves-light btn modal-trigger" href="#eval"><strong>Saisir une évaluation</strong></a>

<div id="eval" class="modal ">
    <h5 class="modal-close">&#10005;</h5>
    <div class="modal-content center">
        <h4>Saisir une évaluation</h4>

        <div class="row">
            <form class="col s12" method="post" action="/controller/creerEval.php">
                <div class="row">
                    <div class="row input-field col s6">
                        <select id ="eleve" name="eleve" class="validate">
                            <?php

                            $numSession=$_SESSION['num'];
                            $num = "SELECT MEM_NIVEAU_FORM FROM PLO_MEMBRE where MEM_NUM='$numSession' ";
                            $resultat = $pdoConnection->query($num);
                            $niveau = $resultat->fetch();
                            $niveauMembre=$niveau['MEM_NIVEAU_FORM'];

                            $req = <<<HEREDOC
SELECT ELE_NUM, ELE_NOM, ELE_PRENOM FROM PLO_ELEVE JOIN TRAVAILLE USING (ELE_NUM) WHERE FOR_CODE = '$niveauMembre' ORDER BY ELE_NOM asc;
HEREDOC;

                            $res = $pdoConnection->query($req);

                            while ($donnees = $res->fetch()) {
                                echo '<option value="'.htmlspecialchars($donnees["ELE_NUM"]).'">'.htmlspecialchars($donnees["ELE_NOM"])." ".htmlspecialchars($donnees["ELE_PRENOM"]).'</option>';
                            }
                            ?>
                        </select>
                        <label>Eleve évalué.e</label>
                    </div>
                    <div class="row input-field col s6">
                        <select id ="aptitude" name="aptitude" class="validate">
                            <?php

                            $numSession=$_SESSION['num'];
                            $num = "SELECT MEM_NIVEAU_FORM FROM PLO_MEMBRE where MEM_NUM='$numSession' ";
                            $resultat = $pdoConnection->query($num);
                            $niveau = $resultat->fetch();
                            $niveauMembre=$niveau['MEM_NIVEAU_FORM'];

                            $req = <<<HEREDOC
                            SELECT APT_CODE, APT_NOM FROM FORMATION LEFT JOIN PLO_COMPETENCES USING(FOR_CODE) LEFT JOIN PLO_APTITUDES USING(COM_CODE) WHERE FOR_CODE = '$niveauMembre';
HEREDOC;

                            $res = $pdoConnection->query($req);

                            while ($donnees = $res->fetch()) {
                                echo '<option value="'.htmlspecialchars($donnees["APT_CODE"]).'">'.htmlspecialchars($donnees["APT_NOM"]).'</option>';
                            }
                            ?>
                        </select>
                        <label>Aptitude évaluée</label>
                    </div>
                </div>
                <div class="row input-field col s12">
                    <select id ="seance" name="seance" class="validate">
                        <?php

                        $req = <<<HEREDOC
SELECT * FROM TRAVAILLE ORDER BY DAT_DATE asc;
HEREDOC;

                        $res = $pdoConnection->query($req);

                        while ($donnees = $res->fetch()) {
                            echo '<option value="'.htmlspecialchars($donnees["DAT_DATE"]).'">'.htmlspecialchars($donnees["DAT_DATE"]).'</option>';
                        }
                        ?>
                    </select>
                    <label>Séance évaluée</label>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="commentaire" class="materialize-textarea" data-length="500" name="commentaire"></textarea>
                        <label for="commentaire">Commentaire à propos du travail effectué</label>
                    </div>
                </div>
                <select id ="estValide" name="estValide" class="validate">
                    <option value="1">Valide</option>
                    <option value="2">Non Valide</option>
                    <option value="3">En cours</option>
                    <option value="4">Absent</option>
                </select>
                <label>état du compte rendu</label>
                <button class="btn waves-effect waves-light" type="submit" name="action" style="margin-top: 20px">Ajouter
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                selectMonths: true,
                selectYears: 10,
                autoClose: true
            }
        );
    });

    $(document).ready(function(){
        $('.timepicker').timepicker({
            format: 'hh:mm',
            autoClose: true,
            twelveHour: false
        });
    });
</script>