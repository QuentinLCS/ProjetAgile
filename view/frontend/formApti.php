<a class="green darken-2 waves-effect waves-light btn modal-trigger" href="#formApti"><strong>Créer une Aptitude</strong></a>

<div id="formApti" class="modal ">
    <h5 class="modal-close">&#10005;</h5>
    <div class="modal-content center">
        <h4>Créer une Aptitude</h4>

        <div class="row">
            <form class="col s12" method="post" action="/controller/CreerApt.php">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="nomApti" type="text" class="validate" name="nomApti" required>
                        <label for="nomApti">Nom de l' Aptitude</label>
                    </div>
                    <div class="row input-field col s6">
                        <select id ="competence" name="competence" class="validate">
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

                            $req = <<<HEREDOC
SELECT * FROM PLO_COMPETENCES ORDER BY COM_CODE asc;
HEREDOC;

                            $res = $pdoConnection->query($req);
                            //session_start();
                            while ($donnees = $res->fetch()) {
                                echo '<option value="'.htmlspecialchars($donnees["COM_CODE"]).'">'.htmlspecialchars($donnees["COM_NOM"]).'</option>';
                            }
                            ?>
                        </select>
                        <label>Compétence mère</label>
                    </div>
                </div>
                <div class="row">
                    
                </div>
                <div class="row">
                    <div class="input-field col s12">
                         <textarea id="descriptionApti" class="materialize-textarea" data-length="500" name="descriptionApti"></textarea>
                         <label for="descriptionApti">Description de l'Aptitude</label>
                    </div>
                </div>
                
                <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
    </div>
</div>