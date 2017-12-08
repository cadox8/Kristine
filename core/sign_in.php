<?php
require "../data/init.php";

if (isset($_POST['name']) && isset($_POST['pass'])){
    $username = mysqli_real_escape_string($mysql, stripslashes($_POST['name']));
    $password = base64_encode(mysqli_real_escape_string($mysql, stripslashes($_POST['pass'])));

    $query = "SELECT * FROM `users` WHERE `name`='$username' and pass='$password'";
    $result = $mysql->query($query);

    if(!$result) header('Location: ../user/login.php?msg=1');

    if (mysqli_num_rows($result) != 1) {
        header('Location: ../user/login.php?msg=2');
    } else {
        $_SESSION['name'] = $username;
        header('Location: ../index.php');
    }
}
