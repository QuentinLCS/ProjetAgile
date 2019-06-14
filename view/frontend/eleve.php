<?php
if(isset($_SESSION['role'])){
    if($_SESSION['role']=='DIRECTEUR' || $_SESSION['role']=='RESPONSABLE'){ 
		echo "<div class='container center'>";
		include_once($pageRepertory . "registerEleve.php");
		echo "</div>";
		echo "SALUT";
	}
}
include_once("gestionEleve.php");

?>