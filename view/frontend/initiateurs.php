<?php
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

$req = <<<HEREDOC
SELECT MEM_NUM,MEM_NOM,MEM_PRENOM,MEM_MAIL FROM PLO_MEMBRE ORDER BY MEM_NUM desc
HEREDOC;

$res = $pdoConnection->prepare($req);
while ($donnees = $res->fetch())
{
    echo htmlspecialchars($donnees['MEM_NUM']).htmlspecialchars($donnees['MEM_NOM']).htmlspecialchars($donnees['MEM_PRENOM']).htmlspecialchars($donnees['MEM_MAIL'])?><br>;
    <a class="waves-effect waves-light btn" href="#registerInitiateur">Directeur</a>
    <a class="waves-effect waves-light btn" href="#registerInitiateur">Responsable</a>
    <a class="waves-effect waves-light btn" href="#registerInitiateur">Initiateur</a><?php

}
$res->closeCursor();

include_once($pageRepertory . "registerInitiateur.php");
include_once($pageRepertory . "registerEleve.php");
?>
