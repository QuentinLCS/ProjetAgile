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
                    <div class="input-field col s6">
                        <input placeholder="Entrez la formation lié à cette compétence" id="formationComp" type="number" class="validate" name="formationComp" required>
                        <label for="formationComp">Numéro de formation</label>
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