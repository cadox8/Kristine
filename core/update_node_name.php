<?php
require "../data/init.php";

if (isset($_POST['node']) && isset($_GET['type']) && isset($_GET['old_node'])) {
    $node = mysqli_real_escape_string($mysql, stripslashes($_POST['node']));
    $old_node = mysqli_real_escape_string($mysql, stripslashes($_GET['old_node']));
    $type = mysqli_real_escape_string($mysql, stripslashes($_GET['type']));
    $username = $_SESSION['name'];

    if ($node == '') header("Location: ../admin/nodes.php?msg=0");

    $result = $mysql->query("SELECT * FROM `users` WHERE `name` = '$username'");
    $user = $result->fetch_object();

    if (!$result) header("Location: ../admin/nodes.php?msg=0");
    if ($user->rank != 5) header("Location: ../admin/nodes.php?msg=0");

    $mysql->query("UPDATE `$type` SET `title`='$node' WHERE `title`='$old_node'");
    header("Location: ../admin/nodes.php?msg=1");
} else {
    header("Location: ../admin/nodes.php?msg=0");
}
