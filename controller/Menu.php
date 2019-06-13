<?php

class Menu
{
    public static function isCliquable($page, $pageToVerify) {
        if ($page == $pageToVerify)
            echo 'class="active center"';
        else
            if ($page == 'Aptitudes') {
                if ($pageToVerify == 'Competences')
                    echo 'class="center active" target="_top" href="../view/frontend/visiteur?page=' . $pageToVerify . '"';
                else
                    echo 'class="center" target="_top" href="../view/frontend/visiteur?page=' . $pageToVerify . '"';
            } else
                echo 'class="center" target="_top" href="?page='.$pageToVerify.'"';
    }
}