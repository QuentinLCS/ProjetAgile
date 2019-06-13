
<a class="blue waves-effect waves-light btn modal-trigger" href="#registerEleve"><strong>Ajouter un élève</strong></a>

<div id="registerEleve" class="modal ">
    <h5 class="modal-close">&#10005;</h5>
    <div class="modal-content center">
        <h4>Ajouter un élève</h4>

        <div class="row">
            <form class="col s12" method="post" action="/controller/CreerEleve.php">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="PrenomEleve" type="text" class="validate" name="prenom" required>
                        <label for="prenom">Entrez Prénom</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="NomEleve" type="text" class="validate" name="nom" required>
                        <label for="nom">Entrez Nom</label>
                    </div>
                    <div class="row input-field col s12">
                    <select id ="Role" name="niveau" class="validate">
                        <option value="1">F1</option>
                        <option value="2">F2</option>
                        <option value="3">F3</option>
                    </select>
                    <label>Rôle de départ</label>
                </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
    </div>
</div>