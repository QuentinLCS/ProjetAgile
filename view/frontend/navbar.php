<nav class="nav-extended z-depth-3">
    <div class="nav-wrapper white">
        <a <?php if ($page != 'home') echo 'href="visiteur.php"'?> class="brand-logo center black-text">Sub'<strong class="blue-text ">Alligators</a>
        <a href="visiteur.php" data-target="mobile-demo" class="sidenav-trigger black-text "><i class="material-icons">menu</i></a>
        <?php 
            if(isset($_SESSION['role'])){
                echo '<ul class="right hide-on-med-and-down">
                        <li><a class="blue modal-trigger" href="#"><strong>MON PROFIL</strong></a></li>
                        <li><a class="blue modal-trigger" href="../../controller/deconnexion.php"><strong>SE DECONNECTER</strong></a></li>
                    </ul>';
            }
            else{
                echo'<ul class="right hide-on-med-and-down">
                    <li><a class="blue modal-trigger" href="#login"><strong>SE CONNECTER</strong></a></li>
                </ul>';
            }
        ?>
        
    </div>
    <div class="nav-content">
        <ul class="tabs tabs-fixed-width grey lighten-4">
                        <li class='tab'>
                            <a <?php Menu::isCliquable($page, 'Initiateurs')?>>Initiateurs</a>
                        </li>
                        <li class="tab">
                            <a <?php Menu::isCliquable($page, 'Competences') ?>>Compétences</a>
                        </li>
            <li class="tab">
                <a class="index-button <?php if ($page == 'home') echo ' active"'; elseif ($page == 'Aptitudes') echo '" target="_top" href="../view/frontend/visiteur.php"';else echo '" target="_top" href="visiteur.php"' ?>><i class="material-icons">home</i></a>
            </li>
            <li class="tab">
                <a <?php Menu::isCliquable($page, 'Planning') ?>>Organisation</a>
            </li>
            <li class="tab">
                <a <?php Menu::isCliquable($page, 'eleve') ?>>Les Élèves</a>
            </li>

        </ul>
    </div>
</nav>

<script>
    $(document).ready(function () {
        $('.sidenav').sidenav();
    });

    $(document).ready(function () {
        $('.tabs').tabs();
    });

    $(".dropdown-trigger").dropdown();

</script>