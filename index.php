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
                        echo '<table class="table is-fullwidth" id="cat.'.$catID.'">';
                        echo '<thead><tr class="is-selected"><th><a href="#cat.'.$catID.'"><span class="icon"><i class="fa fa-folder-open-o"></i></span></span> ' . $cat['title'].'</a></th>';
                        echo '<th>Forums</th>';
                        echo '<th>Latest</th>';
                        echo '</tr></thead><tbody>';
                        //echo '<h1 class="title is-4">' . $cat['title'] . '</h1>';

                        $forumQuery = $mysql->query("SELECT * FROM `forum` WHERE `cat`= $catID");

                        //Forums
                        while ($forum = $forumQuery->fetch_array()) {
                            echo '<tr><th><a href="forum.php?forumID='.$forum['id'].'">' . $forum['title'] . '</a></th>';
                            echo '<td>'.$forumQuery->num_rows.'</td>';
                            echo '<td>None</td></tr>';

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