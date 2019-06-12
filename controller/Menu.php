<?php

class Menu
{
    public static function isCliquable($page, $pageToVerify) {
        if ($page == $pageToVerify)
            echo 'class="active center"';
        else
            echo 'class="center" target="_top" href="?page='.$pageToVerify.'"';
    }
}