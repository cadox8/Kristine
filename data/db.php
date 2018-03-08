<?php
date_default_timezone_set('Europe/Madrid');

define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'kristine');

$mysql = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

if (mysqli_connect_error()) {
    if (!installed) {
        switch (explode("/", $_SERVER['REQUEST_URI'])[2]) {
            case 'user':
            case 'help':
            case 'core':
            case 'admin':
                header("Location: ../install/install.php");
                break;
            default:
                header("Location: install/install.php");
                break;
            }
        } else {
            switch (explode("/", $_SERVER['REQUEST_URI'])[2]) {
                case 'user':
                case 'help':
                case 'core':
                case 'admin':
                    header("Location: ../utils/error.php?id=1");
                    break;
                default:
                    header("Location: utils/error.php?id=1");
                    break;
            }        
        }
    }
}
