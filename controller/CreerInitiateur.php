<?php
    global $base;

    include_once('../model/model.php');

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $mdp = md5($_POST['mdp']);
    $mail = $_POST['mail'];
    $role = $_POST['role'];
    $form=$_POST['formation'];
    $max = 0;

    $req = 'SELECT MAX(MEM_NUM) FROM PLO_MEMBRE';
    $res = $base->query($req);
    foreach (mysqli_fetch_array($res) as $data) {
        $max = $data;
    }
    $max++;

    $req2 = "INSERT INTO PLO_MEMBRE(MEM_NUM, MEM_NOM, MEM_PRENOM, MEM_MAIL, MEM_MDP, MEM_ROLE, MEM_NIVEAU_FORM) VALUES ('$max', '$nom', '$prenom', '$mail', '$mdp', '$role', '$form')";
    $base->query($req2);

    header('Location: ../view/frontend/visiteur.php?page=Initiateurs');
    exit();
?>
