<?php require "data/init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "static/head.php"; ?>
</head>

<body>

    <?php require "static/header.php"; ?>

    <!-- Page -->
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-9"> <!-- Forum -->
                    <?php
                    $catQuery = $mysql->query("SELECT * FROM `cat`");

                    while($cat = $catQuery->fetch_array()) {
                        echo '<h1 class="title is-4">' . $cat['title'] . '</h1>';

                        $catID = $cat['id'];
                        $forumQuery = $mysql->query("SELECT * FROM `forum` WHERE `cat`= $catID");

                        //Forums
                        while ($forum = $forumQuery->fetch_array()) {
                            echo '<a href="forum.php?forumID='.$forum['id'].'">' . $forum['title'] . '</a><br>';

                            $forumID = $forum['id'];
                           /* $postQuery = $mysql->query("SELECT * FROM `posts` WHERE `forum`= $forumID");

                            while ($posts = $postQuery->fetch_array()) {
                                $author = $posts['author'];
                                $usersQuery = $mysql->query("SELECT * FROM `users` WHERE `id`= $author");
                                $user = $usersQuery->fetch_object();

                                echo $posts['title'] . ' by ' . $user->name;
                                echo '<hr>';
                            }
                            $postQuery->free(); */
                        }
                        $forumQuery->free();
                    }
                    $catQuery->free();
                    ?>
                </div>

                <div class="column"> <!-- Info -->
                    h
                </div>
            </div>
        </div>
    </section>
    <?php include "static/footer.php"; ?>
</body>
</html>