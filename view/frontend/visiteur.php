<?php

session_start();
global $base;

include_once("../../controller/Menu.php");

$title = "SubAlligator | ";
$pageRepertory = "./";
if (isset($_GET["page"])) {
    $page = $_GET["page"];
    if  (!file_exists($pageRepertory.strtolower($page).".php")) $page = "Error_404";
    $title = $title . $page;
} else {
    $page = "home";
    $title = $title . "Home";
}
?>
<html lang="fr">
    <head>
        <?php include_once($pageRepertory."head.php"); ?>
        <title><?php echo $title ?></title>
    </head>

    <body>
        <header>
            <?php
                include_once($pageRepertory."navbar.php");
                include_once($pageRepertory . "login.php");
            ?>
        </header>

        <main>
            <?php include_once($pageRepertory.strtolower($page).".php"); ?>
        </main>

        <footer class="page-footer white z-depth-3">
            <?php include_once($pageRepertory."footer.php"); ?>
        </footer>

    </body>
</html>


<script>
    $(document).ready(function(){
        $('.modal').modal();
    });

    $(document).ready(function() {
        $('input#name, input#pass').characterCounter();
    });

    $(document).ready(function(){
        $('select').formSelect();
    });
</script>