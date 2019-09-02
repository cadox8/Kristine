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
            <div class="columns has-text-left">
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
                    echo '<table class="table is-fullwidth is-striped"><thead><tr class="colored">';
                    echo '<th class="is-hidden-mobile"></th> <th>Title</th> <th>By</th>  <th class="is-hidden-mobile">Votes</th>  </tr></thead><tbody>';

                    while ($post = $postsQuery->fetch_array()) {
                        $fixed = 46;
                        if($_COOKIE["size"] < 770) $fixed = 25;

                        $author = $post['author'];
                        $usersQuery = $mysql->query("SELECT * FROM `users` WHERE `id` = '$author'");
                        $users = $usersQuery->fetch_object();
                        $date = date("d-m-y", strtotime($post['date']));
                        $title = (strlen($post['title']) >= $fixed ? $title = substr($post['title'], 0, $fixed).'...' : $title = $post['title']);
                        $icon = (hash_equals($users->icon, "") ? $icon = 'img/user.png' : $icon = 'img/profiles/'.$users->icon);

                        echo '<tr><th class="is-hidden-mobile"><figure class="image is-circle is-48x48"><img src="'.$icon.'"></figure></th>';
                        echo '<td><a href="post.php?id='.$post['id'].'">'.$title.'</a></td>';
                        echo '<td><p><small><strong>'.$users->name.'</strong>  on   '.$date.'</small></p></td>';
                        echo '<td class="is-hidden-mobile">'.$post['likes'].'</td></tr>';
                    }
                    echo '</tbody></table>';
                    $postsQuery->free();
                    ?>
                    </ul>
                </div>
                <div class="column is-hidden-mobile">
                    <?php
                        if (!isset($_SESSION['name'])) {
                            echo '<center><a class="button is-danger" href="user/register.php">'.getMessage('menu', 'sign_up').'</a><br><br>';
                            echo '<a class="button is-info" href="user/login.php">'.getMessage('menu', 'log_in').'</a></center>';
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
                            Ranks::getRank($user->rank, true);
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
