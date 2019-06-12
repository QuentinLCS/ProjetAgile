<?php
try
{
	$bdd = new PDO('mysql:localhost;dbname=agile8_bd;charset=utf8','agile8','ahV2FeemahM6Jiex');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>