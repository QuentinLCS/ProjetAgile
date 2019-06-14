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

<a class="grey darken-1 waves-effect waves-light btn modal-trigger" href="#seance"><strong>Programmer une séance</strong></a>

<div id="seance" class="modal ">
    <h5 class="modal-close">&#10005;</h5>
    <div class="modal-content center">
        <h4>Programmer séance</h4>

        <div class="row">
            <form class="col s12" method="post" action="/controller/creerSeance.php">
                <div class="row">
                    <div class="row input-field col s12">
                        <select id ="niveauSeance" name="niveauSeance" class="validate">
                            <?php

                            $req = "SELECT * FROM FORMATION ORDER BY FOR_CODE ASC";

                            $res = $pdoConnection->query($req);
                            //session_start();
                            while ($donnees = $res->fetch()) {
                                echo '<option value="'.htmlspecialchars($donnees["FOR_CODE"]).'">'.htmlspecialchars($donnees["FOR_NOM"]).'</option>';
                            }
                            $res->closeCursor();
                            ?>
                        </select>
                        <label>Niveau de la séance</label>
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