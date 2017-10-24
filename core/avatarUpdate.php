<?php
require "../data/init.php";

if (isset($_FILES['image']) && isset($_GET['userName'])) {
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];

    $file_helper = explode('.',$_FILES['image']['name']);
    $file_ext = strtolower(end($file_helper));

    $expensions= array("jpeg","jpg","png");

    $username = $_GET['userName'];

    if(in_array($file_ext, $expensions) === false) header("Location: ../user/account.php?username=$username&msg=3");

    if($file_size > 2097152) header("Location: ../user/account.php?username=$username&msg=4");

    if (move_uploaded_file($file_tmp,"../img/profiles/".$file_name)) {
        $username = $_SESSION['name'];
        $query = $mysql->query("SELECT * FROM `users` WHERE `name`='$username'");
        $icon = $query->fetch_object()->icon;

        if ($query->fetch_object()->rank != 5) {
            header("Location: ../user/account.php?username=$username&msg=0");
        }

        if ($icon != '') unlink('../img/profiles/'.$icon);

        $mysql->query("UPDATE `users` SET `icon`='$file_name' WHERE `name`='$username'");
        header("Location: ../user/account.php?username=$username&msg=2");
    } else {
        header("Location: ../user/account.php?username=$username&msg=0");
    }
}
