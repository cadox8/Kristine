<?php
require "../data/init.php";

if (isset($_POST['pass'])) {
    $pass = base64_encode(mysqli_real_escape_string($mysql, stripslashes($_POST['pass'])));
    $username = $_SESSION['name'];

    $result = $mysql->query("SELECT * FROM `users` WHERE `name` = '$username'");
    $user = $result->fetch_object();

    if ($user->rank != 5) {
        header("Location: ../user/security.php?username=$username&msg=0");
    }

    if (!$result) header("Location: ../user/security.php?username=$username&msg=0");

    $mysql->query("UPDATE `users` SET `pass`='$pass' WHERE `name`='$username'");
    header("Location: ../user/security.php?username=$username&msg=1");
} else {
    header("Location: ../user/security.php?username=$username&msg=0");
}
