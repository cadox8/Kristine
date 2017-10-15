<?php
require "data/init.php";

if (isset($_GET['userName']) && is_string($_GET['userName'])) {
    $aid = $_GET['userName'];
} else {
    header("Location: index.php");
}

$usersQuery = $mysql->query("SELECT * FROM `users` WHERE `name` = '$aid'");
$user = $usersQuery->fetch_object();
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
                    <figure class="image">
                        <?php
                            if (hash_equals($user->icon, "")) {
                                echo '<img src="img/user.png">';
                            } else {
                                echo '<img src="img/profiles/'.$user->icon.'">';
                            }
                        ?>
                    </figure><hr>
                    <p>Points: <span class="right"><?php echo $user->points; ?></span></p>
                </div>
                <div class="column is-9">
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
                            if ($user->loc != '') $loc = ', from '.$user->loc;

                            echo $gender.$age.$loc;
                        ?>
                    </p>
                    <hr style="margin-bottom: 6px">
                    <?php
                    echo '<span class="tag is-small';
                        switch ($user->rank) {
                            case 0:
                                echo ' is-light">Member';
                                break;
                            case 8:
                                echo ' is-danger">Administrator';
                                break;
                        }
                        echo '</span>';
                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php require "static/footer.php"; ?>
</body>
</html>