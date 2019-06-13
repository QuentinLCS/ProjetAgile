<a class="green darken-2 waves-effect waves-light btn modal-trigger" href="#formApti"><strong>Créer une Aptitude</strong></a>

<div id="formApti" class="modal ">
    <h5 class="modal-close">&#10005;</h5>
    <div class="modal-content center">
        <h4>Créer une Aptitude</h4>

        <div class="row">
            <form class="col s12" method="post" action="/controller/CreerComp.php">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="nomApti" type="text" class="validate" name="nomApti" required>
                        <label for="nomApti">Nom de la Aptitude</label>
                    </div>
                    <div class="row input-field col s6">
                        <select id ="Role" name="role" class="validate">
                            <?php

                            global $base;

                            include_once("../../model/model.php");

                            $req = 'SELECT * FROM PLO_APTITUDES';
                            $res = $base->query($req);

                            foreach (mysqli_fetch_array($res) as $data) {
                                echo '<option value="'.$data["COM_CODE"].'">'.$data["APT_NOM"].'</option>';
                            }
                            ?>
                        </select>
                        <label>Rôle de départ</label>
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