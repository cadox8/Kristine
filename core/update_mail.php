<?php
require "../data/init.php";

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($mysql, stripslashes($_POST['email']));
    $username = $_SESSION['name'];

    $mysql->query("UPDATE `users` SET `email`='$email' WHERE `name`='$username'");
    header("Location: ../user/account.php?username=$username&msg=1");
} else {
    header("Location: ../user/account.php?username=$username&msg=0");
}
