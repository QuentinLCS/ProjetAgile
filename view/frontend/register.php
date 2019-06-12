<div id="register" class="modal ">
    <h5 class="modal-close">&#10005;</h5>
    <div class="modal-content center">
        <h4>Créer un initiateur</h4>

        <form action="#">

           
  <div class="row">
    <form class="col s12">
      <div class="row">
      <div class="input-field col s6">
          <input id="Prenom" type="text" class="validate">
          <label for="Prenom">Entrez Prénom</label>
        </div>
        <div class="input-field col s6">
          <input id="Nom" type="text" class="validate">
          <label for="Nom">Entrez Nom</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input placeholder="Entrez votre adresse" id="AdresseMail" type="email" class="validate">
          <label for="AdresseMail">Adresse Mail</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input placeholder="Créez son mot de passe" id="MDP" type="password" class="validate">
          <label for="MDP">Mot de passe</label>
        </div>
      </div>
      <button class="btn waves-effect waves-light" type="submit" name="action">Submit
        <i class="material-icons right">send</i>
    </button>
    </form>
  </div>
        
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.modal').modal();
    });

    $(document).ready(function() {
        $('input#name, input#pass').characterCounter();
    });
</script>