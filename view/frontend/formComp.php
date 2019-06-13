<a class="yellow darken-2 waves-effect waves-light btn modal-trigger" href="#formComp"><strong>Créer une compétence</strong></a>

<div id="formComp" class="modal ">
    <h5 class="modal-close">&#10005;</h5>
    <div class="modal-content center">
        <h4>Créer une compétence</h4>

        <div class="row">
            <form class="col s12" method="post" action="/controller/CreerComp.php">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="nomComp" type="text" class="validate" name="nomComp" required>
                        <label for="nomComp">Nom de la compétence</label>
                    </div>
                    <div class="row input-field col s6">
                        <select id ="formation" name="formation" class="validate">
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
SELECT * FROM FORMATION ORDER BY FOR_CODE asc;
HEREDOC;

                            $res = $pdoConnection->query($req);
                            //session_start();
                            while ($donnees = $res->fetch()) {
                                echo '<option value="'.htmlspecialchars($donnees["FOR_CODE"]).'">'.htmlspecialchars($donnees["FOR_NOM"]).'</option>';
                            }
                            ?>
                        </select>
                        <label>Formation mère</label>
                    </div>
                </div>
                <div class="row">
                    
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="description" class="materialize-textarea" data-length="500" name="description"></textarea>
                        <label for="description">Description de la compétence</label>
                    </div>
                </div>
                
                <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
    </div>
</div>