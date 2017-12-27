<?php
session_start();
ob_start();

require "db.php";
require "settings.php";

if ($fol) {
    if (!installed) header("Location: install/install.php");
} else {
    if (!installed) header("Location: ../install/install.php");
}
