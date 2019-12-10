<?php
session_start();
ob_start();

require 'settings.php';
require 'db.php';

require_once './achie/AchievementsManager.php';
$achievements = new AchievementsManager();
$achievements->loadAchievements();

/*if ($fol) {
    if (!installed && explode("/", $_SERVER['REQUEST_URI'])[2] != 'install') header("Location: install/install.php");
} else {
    if (!installed && explode("/", $_SERVER['REQUEST_URI'])[2] != 'install') header("Location: ../install/install.php");
}*/
