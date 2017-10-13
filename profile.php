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
                    <figure class="image is-128x128">
                        <?php
                            if (hash_equals($user->icon, "")) {
                                echo '<img src="img/user.png">';
                            } else {
                                echo '<img src="img/profiles/'.$user->icon.'">';
                            }
                        ?>

                    </figure>
                </div>
                <div class="column is-9">
                    <h2 class="title is-3" style="margin-bottom: -20px"><?php echo $user->name; ?></h2><hr style="margin-bottom: 4px">
                    <?php
                    echo '<span class="tag is-medium';
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

    <?php include "static/footer.php"; ?>
</body>
</html>