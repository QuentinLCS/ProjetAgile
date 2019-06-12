<?php


class Utils
{
    static function modifierRole ($NumUtilisateur, $Role) {
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

//Changer rôle

        $boutonDirecteurs = <<<HEREDOC
UPDATE PLO_MEMBRE
SET MEM_ROLE = '$Role' where MEM_NUM = $NumUtilisateur
HEREDOC;

        $rs1 = $pdoConnection->prepare($boutonDirecteurs);
        $rs1->execute();

    }
}