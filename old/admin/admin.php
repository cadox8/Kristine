<?php
require "../data/init.php";
require '../utils/ranks.php';
require "../lang/lang.php";
$fol = false;

if (!isset($_SESSION['name'])) {
    header("Location: ../index.php");
}

$username = $_SESSION['name'];

$result = $mysql->query("SELECT * FROM `users` WHERE `name` = '$username'");
$user = $result->fetch_object();

if ($user->rank != 5) {
    header("Location: ../user/security.php?username=$username&msg=0");
}

$headerTag = getMessage('menu', 'admin').' - '.forumName;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../static/head.php"; ?>
</head>

<body>

    <?php include "../static/header.php"; ?>


    <!-- Page -->
    <section class="section">
        <div class="container">
            <h2 class="title is-3" style="margin-bottom: -10px"><?php echo getMessage('menu', 'admin'); ?></h2>
            <hr style="margin-bottom: 0"><br>

            <div class="columns">
                <div class="column is-3">
                    <aside class="menu">
                        <p class="menu-label"><?php echo getMessage('menu', 'admin'); ?></p>
                        <ul class="menu-list">
                            <li><a href="nodes.php"><?php echo getMessage('menu', 'admin_nodes'); ?></a></li>
                            <li><a href=""><?php echo getMessage('menu', 'admin_users'); ?></a></li>
                        </ul>
                    </aside>
                </div>
                <div class="column is-6">
                </div>
            </div>
        </div>
    </section>

    <?php include "../static/footer.php"; ?>

</body>
</html>
