<?php
require "data/init.php";
require 'utils/ranks.php';

if (isset($_GET['userName']) && is_string($_GET['userName'])) {
    $aid = $_GET['userName'];
} else {
    header("Location: index.php");
}

$usersQuery = $mysql->query("SELECT * FROM `users` WHERE `name` = '$aid'");
$user = $usersQuery->fetch_object();

$headerTag = $aid.' - '.forumName;
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
                <div class="column is-2">
                    <figure class="image is-profile">
                        <?php
                            if (hash_equals($user->icon, "")) {
                                echo '<img src="img/user.png" alt="avatar">';
                            } else {
                                echo '<img src="img/profiles/'.$user->icon.'" alt="'.$aid.'">';
                            }
                        ?>
                    </figure>
                    <?php
                    echo '<center>';
                    Ranks::getRank($lang, $user->rank, true);
                    echo '</center>';
                    ?>
                    <hr style="margin-bottom: 6px; margin-top: 6px">
                    <p class="showInfo">Points: <span class="right"><?php echo $user->points; ?></span></p>
                </div>
                <div class="column">
                    <nav class="level" style="margin-bottom: -26px">
                        <div class="level level-left">
                            <div class="level-item">
                                <div>
                                    <h2 class="title is-3" style="margin-bottom: -3px"><?php echo $user->name; ?></h2>
                                    <p class="showInfo" style="margin-bottom: -16px">
                                    <?php
                                        $gender = 'Male';
                                        if ($user->gender == 1) $gender = 'Female';

                                        $age = '';
                                        if ($user->birthday != '') {
                                            $birthDate = explode("/", date("dd/mm/YYYY", $user->birthday));
                                            $age = ', '.(date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2])).', ';
                                        }

                                        $loc = '';
                                        if ($user->loc != '') $loc = ', from <a style="color: black" href="https://www.google.es/maps?q='.str_replace(" ", "+", $user->loc).'" target="_blank">'.$user->loc.'</a>';

                                        echo $gender.$age.$loc;
                                    ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <div>
                                    <div class="tabs is-centered">
                                        <ul>
                                            <li class="is-active">
                                                <a>
                                                    <span class="icon is-small"><i class="fa fa-user-o"></i></span>
                                                    <span><?php echo $lang['PROFILE']; ?></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a>
                                                    <span class="icon is-small"><i class="fa fa-info"></i></span>
                                                    <span><?php echo $lang['PROF_DETAILS']; ?></span>
                                                </a>
                                            </li>
                                            <?php
                                                if(hash_equals($_SESSION['name'], $user->name)) {
                                                    echo '<li><a href="user/editProfile.php"><span class="icon is-small"><i class="fa fa-cogs"></i></span>';
                                                    echo '<span>'.$lang['PROF_SETTINGS'].'</span>';
                                                    echo '</a></li>';
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <hr style="margin-bottom: 6px">
                    <?php

                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php require "static/footer.php"; ?>
</body>
</html>