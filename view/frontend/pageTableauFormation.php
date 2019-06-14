<a class="grey darken-2 waves-effect waves-light btn modal-trigger" href="#tableauForm"><strong>Consulter ma formation</strong></a>

<div id="tableauForm" class="modal ">
    <h5 class="modal-close">&#10005;</h5>
    <div class="modal-content center">
        <h4>Tableau de la Formation</h4>
        <div class="row">
            <?php
            include_once("head.php");

            $num = $_SESSION['num'];

            include_once('connexionMySQL.php');

            $reqCheck = "SELECT MEM_NIVEAU_FORM FROM PLO_MEMBRE WHERE MEM_NUM = '$num'";
            $res = $pdoConnection->query($reqCheck);

                while($donnees= $res->fetch()){
                    $idForm=$donnees['MEM_NIVEAU_FORM'];
                }
                include_once("../../controller/donneesFormation.php");
                eleve($idForm);

            $res->closeCursor();

            ?>
        </div>
    </div>
</div>
