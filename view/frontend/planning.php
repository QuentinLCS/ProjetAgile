<?php
echo "planning";
?>
<a>
<div id="createMeeting" class="modal">
    <h5 class="modal-close">&#10005;</h5>
    <div class="modal-content center">
        <h4>Créer une scéance</h4>

        <form action="../../controller/creerSeanceController.php" method="post">

            <div class="input-field">
                <input autofocus type="text" id="name" data-length="20" name="typeSeance">
                <label for="name"> </label>
            </div>
            <br>
            
            <div class="input-field">
                <input type="date" id="start" name="dateSeance">
            </div>
            <br>
            <input type="submit" value="Valider" class="btn btn-large blue">

        </form>
    </div>
</div>

