<a class="blue waves-effect waves-light btn modal-trigger" href="#registerEleve"><strong>Ajouter un élève</strong></a>

<div id="registerEleve" class="modal ">
    <h5 class="modal-close">&#10005;</h5>
    <div class="modal-content center">
        <h4>Créer un élève</h4>

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
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter
                    <i class="material-icons right">envoyé</i>
                </button>
            </form>
        </div>
    </div>
</div>