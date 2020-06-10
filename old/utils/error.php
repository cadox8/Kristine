<?php

$id = 0;

if (isset($_GET['id'])) $id = $_GET['id'];

echo '<br>';

switch ($id) {
    case 1:
        echo 'Error while connecting with the database.';
        break;
    default:
        echo "Undefined error. Please, report it on Kristine's Github.";
        break;
}