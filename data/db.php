<?php
date_default_timezone_set('Europe/Madrid');

define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'kristine');

$mysql = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

if (mysqli_connect_error()) {
    switch (explode("/", $_SERVER['REQUEST_URI'])[2]) {
        case 'user':
        case 'help':
        case 'core':
            header("Location: ../utils/error.php?id=1");
            break;
        default:
            header("Location: utils/error.php?id=1");
            break;
    }
}