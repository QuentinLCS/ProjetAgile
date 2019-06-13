

<div id="modifEleve" class="modal ">
    <h5 class="modal-close">&#10005;</h5>
    <div class="modal-content center">
        <h4>Modifier élève</h4>

        <div class="row">
            <form class="col s12" method="post" action="/controller/Eleve.php">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="nouveauPrenom" type="text" class="validate" name="nouveauPrenom" required>
                        <label for="Prenom">Entrez Prénom</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="nouveauNom" type="text" class="validate" name="nouveauNom" required>
                        <label for="Nom">Entrez Nom</label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="updateInfos">Submit
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
    </div>
</div>