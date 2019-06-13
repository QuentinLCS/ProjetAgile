<?php

ini_set('display_errors','off');

define('DB_USER', 'agile8');
define('DB_PASSWORD', 'ahV2FeemahM6Jiex');
define('DB_HOST', 'localhost');
define('DB_NAME', 'agile8_bd');



include_once('controller/class_database.php');
include_once('controller/class_user.php');
include_once('controller/class_users.php');
include_once('controller/utils_user.php');


session_start();