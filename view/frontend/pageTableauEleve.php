<?php

include_once("head.php");

//?id=2;
if (isset($_GET['id'])){
    $idEleve = $_GET['id'];

    include_once("../../controller/donneesAptitudes.php");

    statutAptitude($idEleve);

}
