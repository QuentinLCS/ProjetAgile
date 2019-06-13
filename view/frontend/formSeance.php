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

<a class="grey darken-2 waves-effect waves-light btn modal-trigger" href="#seance"><strong>Créer une séance</strong></a>

<div id="seance" class="modal ">
    <h5 class="modal-close">&#10005;</h5>
    <div class="modal-content center">
        <h4>Créer une séance</h4>

        <div class="row">
            <form class="col s12" method="post" action="/controller/creerSeance.php">
                <div class="row">
                    <div class="row input-field col s6">
                        <select id ="eleve" name="eleve" class="validate">
                            <?php

                            $req = <<<HEREDOC
SELECT ELE_NUM, ELE_NOM, ELE_PRENOM FROM PLO_ELEVE ORDER BY ELE_NOM asc;
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

                                $req = <<<HEREDOC
SELECT APT_CODE, APT_NOM FROM PLO_APTITUDES ORDER BY APT_NOM asc;
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
                <div class="row">
                    <div class="input-field col s6">
                        <input type="text" class="datepicker" name="date" required>
                        <label for="description">Date</label>
                    </div>
                    <div class="input-field col s6">
                        <input type="text" class="timepicker" name="heure" required>
                        <label for="description">Heure</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="commentaire" class="materialize-textarea" data-length="500" name="commentaire"></textarea>
                        <label for="commentaire">Commentaire à propos du travail effectué</label>
                    </div>
                </div>
                <div class="switch">
                    <label>
                        NON VALIDE
                        <input type="checkbox" name="estValide">
                        <span class="lever"></span>
                        VALIDE
                    </label>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="action" style="margin-top: 20px">Ajouter
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.datepicker').datepicker();
    });

    $(document).ready(function(){
        $('.timepicker').timepicker();
    });
</script>