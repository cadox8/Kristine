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
                        $catID = $cat['id'];
                        echo '<nav class="level" id="cat.'.$catID.'">';
                        echo '<div class="level-left>';
                        echo '<div class="level-item">';
                        echo '<a href="#cat.'.$catID.'"><span class="icon"><i class="fa fa-folder-open-o"></i></span> ' . $cat['title'].'</a>';
                        echo '</div><div class="level-right">';
                        echo '<p class="level-item has-text-centered">Latest</p></div>';
                        echo '</nav><hr>';

                        $forumQuery = $mysql->query("SELECT * FROM `forum` WHERE `cat`= $catID");

                        //Forums
                        while ($forum = $forumQuery->fetch_array()) {
                            echo '<nav class="level"><div class="level-left"><div class="level-item"><div>';
                            echo '<a href="forum.php?forumID='.$forum['id'].'">' . $forum['title'] . '</a><p class="heading">Forums: '.$forumQuery->num_rows.'</p></div></div></div>';
                            echo '<div class="level-right"><p class="level-item">asdasdasdsadasdasdsadsadsadsadsadasdsad</p></nav>';

                            /* $forumID = $forum['id'];
                           $postQuery = $mysql->query("SELECT * FROM `posts` WHERE `forum`= $forumID");

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
                        echo '</tbody>';
                        echo '</table>';
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