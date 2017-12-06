<?php
require "../data/init.php";

if (isset($_POST['title']) && isset($_POST['content'])){
    $title = mysqli_real_escape_string($mysql, stripslashes($_POST['title']));
    $content = mysqli_real_escape_string($mysql, stripslashes($_POST['content']));
    $username = $_SESSION['name'];

    if ($title = '' || $content = '') header("Location: ../new.php");

    $usersQuery = $mysql->query("SELECT * FROM `users` WHERE `name`='$username'");
    $users = $usersQuery->fetch_object();

    $result = $mysql->query("INSERT INTO `posts` (`title`, `content`, `author`) VALUES ('$title', '$content', '$users->id')");

    $id = $mysql->query("SELECT * FROM `posts`")->num_rows;
    header("Location: ../post.php?id='$id'");
}
