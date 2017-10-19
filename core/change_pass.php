<?php
require "../data/init.php";

if (isset($_POST['password'])) {
    $pass = base64_encode(mysqli_real_escape_string($mysql, stripslashes($_POST['password'])));
    $username = $_SESSION['name'];

    $mysql->query("UPDATE `users` SET `pass`='$pass' WHERE `name`='$username'");
    header("Location: ../user/security.php?username=$username&msg=1");
} else {
    header("Location: ../user/security.php?username=$username&msg=0");
}
