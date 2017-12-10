<?php
require "../data/init.php";
require '../utils/ranks.php';
require "../lang/lang.php";
$fol = false;

if (!isset($_SESSION['name'])) header("Location: ../index.php");



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
            <div class="container">
                <h2 class="title is-3" style="margin-bottom: -10px"><?php echo 'Admin'; ?></h2>
                <hr style="margin-bottom: 0"><br>

                <div class="columns">
                    <div class="column is-3">
                        <aside class="menu">
                            <p class="menu-label"><?php echo 'Admin'; ?></p>
                            <ul class="menu-list">
                                <li><a href="" class="is-active"><?php echo 'Nodes'; ?></a></li>
                                <li><a href=""><?php echo 'Users'; ?></a></li>
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
                                echo '<td><a href="node.php?node='.$cat['title'].'">Edit</a></td></tr>';

                                $forumQuery = $mysql->query("SELECT * FROM `forum` WHERE `cat`= $catID");
                                while ($forum = $forumQuery->fetch_array()) {
                                    echo '<tr><td class="is-forum">'.$forum['title'].'<span class="is-type"> Forum</span></td>';
                                    echo '<td> </td>';
                                    echo '<td><a href="node.php?node='.$forum['title'].'">Edit</a></td></tr>';
                                }
                            }
                        ?>
                        </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "../static/footer.php"; ?>

</body>
</html>
