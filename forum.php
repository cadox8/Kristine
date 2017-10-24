<?php
require "data/init.php";
require "lang/lang.php";
require 'utils/ranks.php';

if (isset($_GET['forumID']) && isset($_GET['catName'])) {
    $aid = $_GET['forumID'];
    $cat = $_GET['catName'];
} else {
    header("Location: index.php");
}

if ($mysql->query("SELECT * FROM `forum` WHERE `id` = $aid")->num_rows == 0) {
    header("Location: index.php");
}

$postsQuery = $mysql->query("SELECT * FROM `posts` WHERE `forum` = $aid");

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
                <div class="column is-10">
                    <h1 class="subtitle is-4"><?php
                        if (isset($_SESSION['name'])) {
                            echo $cat.'<a href="new.php?forumID='.$aid.'" class="button is-info right">Create new</a>';
                        } else {
                            echo $cat;
                        }
                     ?></h1><hr>
                    <ul>
                    <?php
                    while ($post = $postsQuery->fetch_array()) {
                        $author = $post['author'];
                        $usersQuery = $mysql->query("SELECT * FROM `users` WHERE `id` = '$author'");
                        $users = $usersQuery->fetch_object();
                        $date = date("d-m-y", strtotime($post['date']));
                        if (hash_equals($users->icon, "")) {
                            $icon = 'img/user.png';
                        } else {
                            $icon = 'img/profiles/'.$users->icon.'';
                        }

                        echo '<nav class="level has-borders" style="background-color: rgb(196, 84, 84)">';
                        echo '<div class="level-left">';
                        echo '<div class="level-item ajust-left is-bar">';
                        echo '<p class="has-text-weight-bold has-text-white is-size-5 has-text-centered">Title</p>';
                        echo '</div></div>';

                        echo '<div class="level-right"><div class="level-item ajust-right">';
                        echo '<p class="has-text-weight-bold has-text-white is-size-5 has-text-centered">By</p></div>';
                        echo '<div class="level-item ajust-right"><p class="has-text-weight-bold has-text-white is-size-5 has-text-centered">At</p></div>';
                        echo '</div></nav>';
                        echo '<hr style="border-style: solid; border-width: 3px; margin-top: -24px;">';

                        echo '<li><nav class="level">';
                        echo '<div class="level-left"><div class="level-item ajust-left"><figure class="image is-48x48"><img src="'.$icon.'"></figure>';
                        echo '<a style="padding: 5px" href="posts.php?id='.$post['id'].'">' . $post['title'] . '</a></div></div>';
                        echo '<div class="label-right"><div class="level-item ajust-left"><p>'.$users->name.'</p></div>';
                        echo '<div class="level-item ajust-left"><p>'.$date.'</p></div>';
                        echo '</div></nav></li>';
                    }
                    $postsQuery->free();
                    ?>
                    </ul>
                </div>
                <div class="column is-hidden-mobile">
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
