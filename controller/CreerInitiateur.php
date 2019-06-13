<?php
    global $base;

    include_once('../model/model.php');

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $mdp = md5($_POST['mdp']);
    $mail = $_POST['mail'];
    $role = $_POST['role'];
    $max = 0;

    $req = 'SELECT MAX(MEM_NUM) FROM PLO_MEMBRE';
    $res = $base->query($req);
    foreach (mysqli_fetch_array($res) as $data) {
        $max = $data;
    }
    $max++;

    $req2 = "INSERT INTO PLO_MEMBRE VALUES ('$max', '$prenom', '$nom', '$mail', '$mdp', '$role')";
    $base->query($req2);

    header('Location: /index.php/?page=Initiateurs');
    exit();
?>
