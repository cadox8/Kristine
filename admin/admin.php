<?php
require "../data/init.php";
require '../utils/ranks.php';
require "../lang/lang.php";
$fol = false;

if (!isset($_SESSION['name'])) {
    header("Location: ../index.php");
}

$headerTag = $lang['SET_AC'].' - '.forumName;
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
            <h2 class="title is-3" style="margin-bottom: -10px"><?php echo 'Admin'; ?></h2>
            <hr style="margin-bottom: 0"><br>

            <div class="columns">
                <div class="column is-3">
                    <aside class="menu">
                        <p class="menu-label"><?php echo 'Admin'; ?></p>
                        <ul class="menu-list">
                            <li><a href="nodes.php"><?php echo 'Nodes'; ?></a></li>
                            <li><a href=""><?php echo 'Users'; ?></a></li>
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
