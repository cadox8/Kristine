<?php
require "data/init.php";
require "lang/lang.php";
require 'utils/ranks.php';

if (isset($_GET['id'])) {
    $aid = $_GET['id'];
} else {
    header("Location: index.php");
}

if ($mysql->query("SELECT * FROM `posts` WHERE `id` = $aid")->num_rows == 0) {
    header("Location: index.php");
}

$postsQuery = $mysql->query("SELECT * FROM `posts` WHERE `id` = $aid");
$posts = $postsQuery->fetch_object();

$headerTag = $posts->title.' - '.forumName;
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
            <h1 class="subtitle is-4"><?php echo $posts->title; ?></h1><hr>

            <div class="columns">
                <div class="column is-2">
                    <?php
                    $uID = $posts->author;
                    $usersQuery = $mysql->query("SELECT * FROM `users` WHERE `id`='$uID'");
                    $user = $usersQuery->fetch_object();
                    echo '<center><figure class="image is-128x128 is-profile">';
                    if (hash_equals($user->icon, "")) {
                        echo '<img src="img/user.png" alt="avatar">';
                    } else {
                        echo '<img src="img/profiles/'.$user->icon.'" alt="'.$uID.'">';
                    }
                    echo '</figure>';
                    Ranks::getRank($lang, $user->rank, true);
                    echo '</center>';
                    echo '<center><span class="tag is-info">'.$user->name.'</span>';
                    echo '</center>';
                     ?>
                </div>
                <div class="column">
                    <?php echo $posts->content ?>
                </div>
            </div>
        </div>
    </section>

    <?php include "static/footer.php"; ?>
</body>
</html>
