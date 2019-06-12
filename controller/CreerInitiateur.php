<?php
//Recuperation des donnees
$num = '2';
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$mdp = md5($_POST['mdp']);
$mail = $_POST['mail'];

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

//num
$reqNum = <<<HEREDOC
SELECT MAX(MEM_NUM) as NOMBRE FROM PLO_MEMBRE
HEREDOC;

$rsNum = $pdoConnection->prepare($reqNum);
$rsNum->execute();

foreach($rsNum as $valeur){
}
$num = $valeur['NOMBRE']+1;

//Insertion des valeurs dans la base de donnee
$insertsql = <<<HEREDOC
INSERT INTO PLO_MEMBRE VALUES ('$num', '$prenom', '$nom', '$mail', '$mdp', 'INITIATEUR')
HEREDOC;

$rs1 = $pdoConnection->prepare($insertsql);
$rs1->execute();

header("Location: ../index.php");




 ?>
