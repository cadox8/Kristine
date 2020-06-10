<?php
require "../data/init.php";

if (isset($_POST['lang'])) {
    $lang = mysqli_real_escape_string($mysql, stripslashes($_POST['lang']));
    $username = $_SESSION['name'];

    $result = $mysql->query("SELECT * FROM `users` WHERE `name` = '$username'");
    $user = $result->fetch_object();

    if ($user->rank != 5) {
        header("Location: ../user/preferences.php?username=$username&msg=0");
    }

    if (!$result) header("Location: ../user/preferences.php?username=$username&msg=0");

    $mysql->query("UPDATE `users` SET `lang`='$lang' WHERE `name`='$username'");
    header("Location: ../user/preferences.php?username=$username&msg=1");
} else {
    header("Location: ../user/preferences.php?username=$username&msg=0");
}
