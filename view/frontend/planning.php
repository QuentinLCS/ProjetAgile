<?php
echo "planning";

//Connection Base de Donnee

$dbhost = 'localhost';
$dbuser = 'agile8';
$dbpass = 'ahV2FeemahM6Jiex';
$dsn = 'mysql:host=localhost;dbname=agile8_bd;charset=utf8';

try {
  $pdoConnection = new PDO($dsn, $dbuser, $dbpass);
  $pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Erreur connection : ".$e->getMessage();
}
?>
<a class="blue waves-effect waves-light btn modal-trigger" href="#planning"><strong>Ajouter une séance</strong></a>

<div id="planning" class="modal ">
    <h5 class="modal-close">&#10005;</h5>
    <div class="modal-content center">
        <h4>Ajouter une séance</h4>

        <div class="row">
            <form class="col s12" method="post" action="/controller/creerSeanceController.php">
                <div class="row">
                    <div class="input-field col s6">
                        <input autofocus type="text" id="name" data-length="20" name="typeSeance">
              			<label for="name"> </label>
                    </div>
                    
                    <br>
                    <div class="input-field col s6">
              			<input type="date" id="start" name="dateSeance">
                    </div>
                </div>
                <label for="name">Nom</label>
                <input autofocus type="text" id="name" data-length="20" name="nomMembre">
                <label for="name">Prenom</label>
                <input autofocus type="text" id="name" data-length="20" name="prenomMembre">
                <button class="btn waves-effect waves-light" type="submit" name="action">Ajouter
                    <i class="material-icons right">send</i>
                </button>

            </form>
            
        </div>
    </div>
</div>
