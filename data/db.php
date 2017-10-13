<?php
date_default_timezone_set('Europe/Madrid');

define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'kristine');

$mysql = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

if ($mysql->connect_errno) die("ERROR : -> ".$mysql->connect_error);

$installed = true;