<?php
//Lang
$lang = "en_EN";

if (isset($_SESSION['name'])) {
    $usersQueryLang = $mysql->query("SELECT * FROM `users`");
    while ($userLang = $usersQueryLang->fetch_array()) {
        if (hash_equals($_SESSION['name'], $userLang['name'])) $lang = $userLang['lang'];
    }
    $usersQueryLang->free();
}

switch ($lang) {
    case 'en_EN':
        $lang_file = 'en_EN.php';
        break;
    case 'es_ES':
        $lang_file = 'es_ES.php';
        break;
    default:
        $lang_file = 'en_EN.php';
        break;
}
include_once $lang_file;