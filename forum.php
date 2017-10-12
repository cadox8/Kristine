<?php
require "data/init.php";

if (isset($_GET['forumID']) && is_string($_GET['forumID'])) {
    $aid = $_GET['forumID'];
} else {
    header("Location: index.php");
}

$postsQuery = $mysql->query("SELECT * FROM `posts` WHERE `forum` = $aid");

/*$usersQuery = $mysql->query("SELECT * FROM `users` WHERE `user` = $forums->author");
$users = $usersQuery->fetch_object();*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "static/head.php"; ?>
</head>

<body>

    <?php require "static/header.php"; ?>

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-9">
                    <?php
                    while ($post = $postsQuery->fetch_array()) {
                        echo '<h1 class="subtitle is-4">' . $post['title'] . '</h1><br>';

                        /* $postQuery = $mysql->query("SELECT * FROM `posts` WHERE `forum`= $forumID");

                         while ($posts = $postQuery->fetch_array()) {
                             $author = $posts['author'];
                             $usersQuery = $mysql->query("SELECT * FROM `users` WHERE `id`= $author");
                             $user = $usersQuery->fetch_object();

                             echo $posts['title'] . ' by ' . $user->name;
                             echo '<hr>';
                         }
                          */
                        echo '<hr>';
                    }
                    $postsQuery->free();
                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php include "static/footer.php"; ?>
</body>
</html>
