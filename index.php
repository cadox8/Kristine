<?php
require "data/init.php";
require "lang/lang.php";
?>
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
                        echo '<nav class="level has-borders" style="background-color: #FF9797" id="cat.'.$catID.'">';
                        echo '<div class="level-left">';
                        echo '<div class="level-item">';
                        echo '<a class="has-text-weight-bold has-text-black is-size-5 underline" style="padding: 10px;" href="#cat.'.$catID.'"><span class="icon"><i class="fa fa-folder-open-o"></i></span> ' . $cat['title'].'</a>';
                        echo '</div></div><div class="level-right">';
                        echo '<p class="level-item has-text-centered has-text-weight-bold has-text-black is-size-5" style="padding-right: 10px;">Latest</p></div>';
                        echo '</nav>';
                        echo '<hr class="is-cat">';

                        $forumQuery = $mysql->query("SELECT * FROM `forum` WHERE `cat`= $catID");

                        //Forums
                        while ($forum = $forumQuery->fetch_array()) {
                            echo '<nav class="level"><div class="level-left"><div class="level-item"><div>';
                            echo '<a href="forum.php?forumID='.$forum['id'].'&catName='.$cat['title'].'">' . $forum['title'] . '</a><p class="heading">Forums: '.$forumQuery->num_rows.'</p></div></div></div>';
                            echo '<div class="level-right"><p class="level-item">asdasdasdsadasdasdsadsadsadsadsadasdsad</p></nav>';
                        }
                        $forumQuery->free();
                    }
                    $catQuery->free();
                    ?>
                </div>

                <div class="column"> <!-- Info -->
                    TODO: User tab
                </div>
            </div>
        </div>
    </section>
    <?php include "static/footer.php"; ?>
</body>
</html>
