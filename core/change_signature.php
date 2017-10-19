<?php
require "../data/init.php";

if (isset($_POST['signature'])) {
    $signature = mysqli_real_escape_string($mysql, stripslashes($_POST['signature']));
    $username = $_SESSION['name'];

    $mysql->query("UPDATE `users` SET `signature`='$signature' WHERE `name`='$username'");
    header("Location: ../user/signature.php?username=$username&msg=1");
} else {
    header("Location: ../user/signature.php?username=$username&msg=0");
}
