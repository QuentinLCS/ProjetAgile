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
                    <div class="input-field col s6">
                        <input placeholder="Entrez la compétence lié à cette Aptitude" id="compApti" type="number" class="validate" name="compApti" required>
                        <label for="compApti">Numéro de compétence</label>
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