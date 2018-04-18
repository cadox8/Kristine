<?php
require "../data/init.php";
require '../utils/ranks.php';
require "../lang/lang.php";
$fol = false;

if (!isset($_SESSION['name'])) header("Location: ../index.php");

$username = $_SESSION['name'];

$result = $mysql->query("SELECT * FROM `users` WHERE `name` = '$username'");
$user = $result->fetch_object();

if ($user->rank != 5) {
    header("Location: ../user/security.php?username=$username&msg=0");
}

$headerTag = $lang['NODES'].' - '.forumName;
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
                        <p class="menu-label"><?php echo $lang['MENU_ADMIN']; ?></p>
                        <ul class="menu-list">
                            <li><a href="nodes.php"><?php echo $lang['NODES']; ?></a></li>
                            <li><a href=""><?php echo $lang['USERS']; ?></a></li>
                        </ul>
                    </aside>
                </div>
                <div class="column is-8">
                    <table class="table is-striped is-fullwidth">

                        <tbody>
                        <?php
                            $catQuery = $mysql->query("SELECT * FROM `cat`");
                            while($cat = $catQuery->fetch_array()) {
                                $catID = $cat['id'];
                                echo '<tr><td>'.$cat['title'].'<span class="is-type"> Category</span></td>';
                                echo '<td></td>';
                                echo '<td><a href="node.php?node='.$cat['title'].'&type=cat">'.$lang['EDIT'].'</a></td>';

                                $forumQuery = $mysql->query("SELECT * FROM `forum` WHERE `cat`= $catID");
                                while ($forum = $forumQuery->fetch_array()) {
                                    echo '<tr><td class="is-forum">'.$forum['title'].'<span class="is-type"> Forum</span></td>';
                                    echo '<td> </td>';
                                    echo '<td><a href="node.php?node='.$forum['title'].'&type=forum">'.$lang['EDIT'].'</a></td></tr>';
                                }
                            }
                        ?>
                    </tbody></table>
                    <a class="button is-success" href="createNode.php">Create Node</a>
                </div>
            </div>
        </div>
    </section>

    <?php include "../static/footer.php"; ?>

</body>
</html>
