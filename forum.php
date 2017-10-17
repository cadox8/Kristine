<?php
require "data/init.php";

if (isset($_GET['forumID']) && isset($_GET['catName'])) {
    $aid = $_GET['forumID'];
    $cat = $_GET['catName'];
} else {
    header("Location: index.php");
}

$postsQuery = $mysql->query("SELECT * FROM `posts` WHERE `forum` = $aid");

/*$usersQuery = $mysql->query("SELECT * FROM `users` WHERE `user` = $forums->author");
$users = $usersQuery->fetch_object();*/

$headerTag = $cat.' - '.forumName;
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
                    <h1 class="subtitle is-4"><?php echo $cat; ?></h1><hr>
                    <ul>
                    <?php
                    while ($post = $postsQuery->fetch_array()) {
                        $author = $post['author'];
                        $usersQuery = $mysql->query("SELECT `name` FROM `users` WHERE `id` = '$author'");
                        echo '<li><a href="posts.php?id='.$post['id'].'">' . $post['title'] . '</a>';
                        echo '<p class="heading">By: '.$usersQuery->fetch_object()->name.'</p>';
                        echo '</li>';
                    }
                    $postsQuery->free();
                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php include "static/footer.php"; ?>
</body>
</html>
