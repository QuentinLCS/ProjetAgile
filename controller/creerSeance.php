<?php
global $base;

include_once('../model/model.php');

$eleveNum = $_POST['eleve'];
$aptitude = $_POST['aptitude'];
$date = $_POST['date'];
$heure = $_POST['heure'];
$commentaire = $_POST['commentaire'];
$estValide = $_POST['estValide'];

echo $eleveNum." ; ";
echo $aptitude." ; ";
echo $date." ; ";
echo $heure." ; ";
echo $commentaire." ; ";
echo $estValide;

$req = 'SELECT MAX(MEM_NUM) FROM PLO_MEMBRE';
$res = $base->query($req);
foreach (mysqli_fetch_array($res) as $data) {
    $max = $data;
}
$max++;

$req2 = "INSERT INTO PLO_MEMBRE(MEM_NUM, MEM_NOM, MEM_PRENOM, MEM_MAIL, MEM_MDP, MEM_ROLE) VALUES ('$max', '$nom', '$prenom', '$mail', '$mdp', '$role')";
$base->query($req2);

//header('Location: ../view/frontend/visiteur.php?page=Initiateurs');
//exit();
?>
