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
                <select name="selectMembre">
                    <?php
                    include_once('../view/frontend/connexionMySQL.php');
                    $sql = "SELECT MEM_NUM, MEM_NOM, MEM_PRENOM FROM PLO_MEMBRE";
                    $res = mysql_query($sql) or exit(mysql_error());
                    while($data=mysql_fetch_array($res)) {
                       echo '<option>'.$data["MEM_NOM"].$data["MEM_PRENOM"].'</option><br/>';
                    }
                    ?>
                    <input type="hidden" name="numMembre" values <?php echo $data["MEM_NUM"];?>>
                </select>
            </div>
            <div class="input-field">
                <input type="date" id="start" name="dateSeance">
            </div>
            <br>
            <input type="submit" value="Valider" class="btn btn-large blue">

        </form>
    </div>
</div>