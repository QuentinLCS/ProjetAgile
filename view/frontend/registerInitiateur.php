<div id="registerInitiateur" class="modal ">
    <h5 class="modal-close">&#10005;</h5>
    <div class="modal-content center">
        <h4>Créer un initiateur</h4>

        <div class="row">
            <form class="col s12" method="post" action="controller/CreeCompteTest.php">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="Prenom" type="text" class="validate" name="prenom" required>
                        <label for="Prenom">Entrez Prénom</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="Nom" type="text" class="validate" name="nom" required>
                        <label for="Nom">Entrez Nom</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="Entrez votre adresse" id="AdresseMail" type="email" class="validate" name="mail" required>
                        <label for="AdresseMail">Adresse Mail</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input placeholder="Créez son mot de passe" id="MDP" type="password" class="validate" name="mdp" required>
                        <label for="MDP">Mot de passe</label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>

        <script>
            $(document).ready(function(){
                $('.modal').modal();
            });

            $(document).ready(function() {
                $('input#name, input#pass').characterCounter();
            });
        </script>