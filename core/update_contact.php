<?php
require "../data/init.php";

if (isset($_POST['twitter'])) {
    $twitter = mysqli_real_escape_string($mysql, stripslashes($_POST['twitter']));
    $username = $_SESSION['name'];

    if ($mysql->query("SELECT * FROM `users` WHERE `name`='$username'")->fetch_object()->rank != 5) {
        header("Location: ../user/account.php?username=$username&msg=0");
    }

    $mysql->query("UPDATE `users` SET `twitter`='$twitter' WHERE `name`='$username'");
    header("Location: ../user/account.php?username=$username&msg=5");
} else {
    if (isset($_POST['skype'])) {
        $skype = mysqli_real_escape_string($mysql, stripslashes($_POST['skype']));
        $username = $_SESSION['name'];

        if ($mysql->query("SELECT * FROM `users` WHERE `name`='$username'")->fetch_object()->rank != 5) {
            header("Location: ../user/account.php?username=$username&msg=0");
        }

        $mysql->query("UPDATE `users` SET `skype`='$skype' WHERE `name`='$username'");
        header("Location: ../user/account.php?username=$username&msg=5");
    } else {
        if (isset($_POST['face'])) {
            $face = mysqli_real_escape_string($mysql, stripslashes($_POST['twitter']));
            $username = $_SESSION['name'];

            if ($mysql->query("SELECT * FROM `users` WHERE `name`='$username'")->fetch_object()->rank != 5) {
                header("Location: ../user/account.php?username=$username&msg=0");
            }

            $mysql->query("UPDATE `users` SET `facebook`='$face' WHERE `name`='$username'");
            header("Location: ../user/account.php?username=$username&msg=5");
        } else {
            header("Location: ../user/account.php?username=$username&msg=0");
        }
    }
}
