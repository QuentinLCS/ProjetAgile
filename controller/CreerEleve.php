<?php
    global $base;

    include_once ("../model/model.php");

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $max = 0;

    $req = 'SELECT MAX(ELE_NUM) FROM PLO_ELEVE';
    $res = $base->query($req);
    foreach (mysqli_fetch_array($res) as $data) {
        $max = $data;
    }
    $max++;

    $req2 = "INSERT INTO PLO_ELEVE VALUES ('$max', '$prenom', '$nom')";
    $base->query($req2);

    header('Location: ../view/frontend/visiteur.php?page=eleve');
    exit();
?>
