<?php
require "../data/init.php";

if (isset($_POST['title']) && isset($_POST['content'])){
    $title = mysqli_real_escape_string($mysql, stripslashes($_POST['title']));
    $content = mysqli_real_escape_string($mysql, stripslashes($_POST['content']));
    $username = $_SESSION['name'];

    $usersQuery = $mysql->query("SELECT * FROM `users` WHERE `name`='$username'");
    $users = $usersQuery->fetch_object();

    $result = $mysql->query("INSERT INTO `posts` (`title`, `content`, `author`) VALUES ('$title', '$content', '$users->id')");

    echo $result;
}
