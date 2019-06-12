<nav class="nav-extended z-depth-3">
    <div class="nav-wrapper white">
        <a <?php if ($page != 'home') echo 'href="/"'?> class="brand-logo center black-text">Sub<strong class="green-text ">Alligator</strong></a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger black-text "><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a class="blue modal-trigger" href="#login"><strong>CREER UN INITIATEUR</strong></a></li>
        </ul>
    </div>
    <div class="nav-content">
        <ul class="tabs tabs-fixed-width grey lighten-4">
            <li class="tab">
                <a <?php Menu::isCliquable($page, 'News') ?>>News</a>
            </li>
            <li class="tab">
                <a class="dropdown-trigger<?php if ($page == 'Manga' || $page == 'Illustration' || $page == 'Scenario' || $page == 'Recrutement') echo ' active"'?>" href="#" data-target="creations">Créations</a>
            </li>
            <li class="tab">
                <a class="index-button <?php if ($page == 'home') echo ' active"'; else echo '" target="_top" href="/"' ?>><i class="material-icons">home</i></a>
            </li>
            <li class="tab">
                <a <?php Menu::isCliquable($page, 'Lexique') ?>>Lexique</a>
            </li>
            <li class="tab">
                <a <?php Menu::isCliquable($page, 'Support') ?>>Support</a>
            </li>
        </ul>
    </div>
</nav>

<ul class="sidenav grey darken-4" id="mobile-demo">
    <li><a class="blue white-text waves-effect waves-light modal-trigger" href="#login"><i class="material-icons white-text">account_circle</i><strong>SE CONNECTER</strong></a></li>
</ul>

<ul id="creations" class="dropdown-content">
    <li><a <?php Menu::isCliquable($page, 'Manga') ?>>Mangas</a></li>
    <li><a <?php Menu::isCliquable($page, 'Illustration') ?>>Illustrations</a></li>
    <li><a <?php Menu::isCliquable($page, 'Scenario') ?>>Scénarios</a></li>
    <li class="divider"></li>
    <li><a <?php Menu::isCliquable($page, 'Recrutement') ?>>Recrutement</a></li>
</ul>

<script>
    $(document).ready(function () {
        $('.sidenav').sidenav();
    });

    $(document).ready(function () {
        $('.tabs').tabs();
    });

    $(".dropdown-trigger").dropdown();

</script>