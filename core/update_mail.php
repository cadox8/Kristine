<?php
require "../data/init.php";

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($mysql, stripslashes($_POST['email']));
    $username = $_SESSION['name'];

    $updateEmailQuery = $mysql->query("UPDATE `users` SET `email`='$email' WHERE `name`='$username'");

    header("Location: ../user/editProfile.php?msg=1");
}