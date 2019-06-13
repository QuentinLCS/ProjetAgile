<?php
echo "planning";
?>
<a class="blue waves-effect waves-light btn modal-trigger" href="#registerEleve"><strong>Ajouter une séance</strong></a>

<div id="registerEleve" class="modal ">
    <h5 class="modal-close">&#10005;</h5>
    <div class="modal-content center">
        <h4>Ajouter une séance</h4>

        <div class="row">
            <form class="col s12" method="post" action="/controller/CreerEleve.php">
                <div class="row">
                    <div class="input-field col s6">
                        <input autofocus type="text" id="name" data-length="20" name="typeSeance">
              			<label for="name"> </label>
                    </div>
                    
                    <div class="input-field col s6">
              			<input type="date" id="start" name="dateSeance">
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
    </div>
</div>
