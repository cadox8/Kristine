<!-- Kristine. Made by @Cadox8 (http://cadox8.me) -->

<?php
require "data/init.php";
require "lang/lang.php";
require 'utils/ranks.php';
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
            <div class="columns has-text-left">
                <div class="column is-10"> <!-- Forum -->
                    <?php
                    $catQuery = $mysql->query("SELECT * FROM `cat`");

                    while($cat = $catQuery->fetch_array()) {
                        $catID = $cat['id'];
                        echo '<nav class="level has-borders" style="background-color: rgb(196, 84, 84)" id="cat.'.$catID.'">';
                        echo '<div class="level-left">';
                        echo '<div class="level-item">';
                        echo '<a class="has-text-weight-bold is-size-5" style="padding: 10px; color: white;" href="#cat.'.$catID.'"><span class="icon has-text-warning"><i class="far fa-folder-open"></i></span> <span>' . $cat['title'].'</span></a>';
                        echo '</div></div></nav>';
                        echo '<hr style="border-style: solid; border-width: 3px; margin-top: -24px;">';

                        $forumQuery = $mysql->query("SELECT * FROM `forum` WHERE `cat`= $catID");

                        //Forums
                        while ($forum = $forumQuery->fetch_array()) {
                            echo '<nav class="level"><div class="level-left"><div class="level-item"><span class="icon is-large has-text-gray" style="margin-right: 5px"><i class="far fa-2x fa-comments"></i></span><div>';
                            echo '<a class="is-cat" href="forum.php?forumID='.$forum['id'].'&catName='.$cat['title'].'"> ' . $forum['title'] . '</a><p class="heading"> Forums: '.$forumQuery->num_rows.'</p></div></div></div>';
                            //echo '<div class="level-right"><p class="level-item">asdasdasdsadasdasdsadsadsadsadsadasdsad</p>';
                            echo '</nav>';
                        }
                        $forumQuery->free();
                    }
                    $catQuery->free();
                    ?>
                </div>

                <div class="column is-hidden-mobile"> <!-- Info -->
                    <?php
                        if (!isset($_SESSION['name'])) {
                            echo '<center><a class="button is-danger" href="user/register.php">'.$lang['SIGN_UP'].'</a><br><br>';
                            echo '<a class="button is-info" href="user/login.php">'.$lang['LOG_IN'].'</a></center>';
                        } else {
                            $aid = $_SESSION['name'];
                            $usersQuery = $mysql->query("SELECT * FROM `users` WHERE `name` = '$aid'");
                            $user = $usersQuery->fetch_object();

                            echo '<center><figure class="image is-profile is-128x128">';
                            if (hash_equals($user->icon, "")) {
                                echo '<img src="img/user.png" alt="avatar">';
                            } else {
                                echo '<img src="img/profiles/'.$user->icon.'" alt="'.$aid.'">';
                            }
                            echo '</figure>';
                            Ranks::getRank($lang, $user->rank, true);
                            echo '</center>';
                            echo '<center><span class="tag is-info">'.$user->name.'</span>';
                            echo '</center>';
                            $totUsers = $mysql->query("SELECT * FROM `users`")->num_rows;
                            echo '<span class="has-text-left">Users</span><span class="has-text-right">'.$totUsers.'</span>';
                        }
                    ?>
                    <hr style="margin-bottom: 6px; margin-top: 6px">
                </div>
            </div>
        </div>
    </section>
    <?php include "static/footer.php"; ?>
</body>
</html>
